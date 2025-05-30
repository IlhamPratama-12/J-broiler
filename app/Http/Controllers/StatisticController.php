<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public function statisticReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DB::table('sale_details')
            ->join('sales', 'sales.id', '=', 'sale_details.sale_id');

        if ($startDate && $endDate) {
            $query->whereBetween('sales.date', [$startDate, $endDate]);
        }

        $categories = (clone $query)
            ->select('sales.payment_method as method', DB::raw('SUM(sale_details.subtotal) as total'))
            ->groupBy('method')
            ->pluck('total', 'method')
            ->toArray();

        $salesRaw = (clone $query)
            ->selectRaw("DATE_FORMAT(sales.date, '%b-%Y') as month, SUM(sale_details.subtotal) as total")
            ->groupBy(DB::raw("DATE_FORMAT(sales.date, '%b-%Y')"))
            ->orderByRaw("MIN(sales.date)")
            ->limit(12)
            ->get();

        $sales = $salesRaw->map(function ($item) {
            return [
                'month' => $item->month,
                'total' => (float) $item->total,
            ];
        })->toArray();

        $grouped = (clone $query)
            ->join('partnerships', 'sales.partnership_id', '=', 'partnerships.id')
            ->selectRaw("YEAR(sales.date) as year, partnerships.name as partnership, SUM(sale_details.subtotal) as total")
            ->groupBy('year', 'partnership')
            ->orderBy('year')
            ->get();

        $groupedSales = [];
        foreach ($grouped as $item) {
            if (!isset($groupedSales[$item->year])) {
                $groupedSales[$item->year] = [];
            }
            $groupedSales[$item->year][$item->partnership] = (float) $item->total;
        }

        // Tambahkan kode ini untuk mendapatkan data penjualan per minggu
        $weeklySalesRaw = (clone $query)
            ->selectRaw("WEEK(sales.date, 1) as week, YEAR(sales.date) as year, SUM(sale_details.subtotal) as total, MIN(sales.date) as start_date, MAX(sales.date) as end_date")
            ->groupBy('year', 'week')
            ->orderBy('year')
            ->orderBy('week')
            ->get();

        $weeklySales = $weeklySalesRaw->map(function ($item) {
            return [
                'week_label' => 'Minggu ke-' . $item->week . ' (' . \Carbon\Carbon::parse($item->start_date)->format('d M Y') . ' - ' . \Carbon\Carbon::parse($item->end_date)->format('d M Y') . ')',
                'total' => (float) $item->total,
            ];
        })->toArray();
        // Akhir penambahan kode

        return view('admin.pages.reports.statistic', compact('categories', 'sales', 'groupedSales', 'startDate', 'endDate', 'weeklySales')) // Tambahkan 'weeklySales' ke sini
            ->with('page', 'statistic-report');
    }

    public function prediksiBulanDepan()
{
    $monthlySales = DB::table('sales')
        ->selectRaw("DATE_FORMAT(date, '%Y-%m') as bulan, SUM(total) as total")
        ->where('status', 'ACTIVE') // Filter sesuai kebutuhan
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    $x = [];
    $y = [];
    $i = 1;
    foreach ($monthlySales as $row) {
        $x[] = $i++;
        $y[] = $row->total;
    }

    if (count($x) < 2) {
        return back()->with('error', 'Data tidak cukup untuk prediksi.');
    }

    $n = count($x);
    $x_mean = array_sum($x) / $n;
    $y_mean = array_sum($y) / $n;

    $num = 0;
    $den = 0;
    for ($i = 0; $i < $n; $i++) {
        $num += ($x[$i] - $x_mean) * ($y[$i] - $y_mean);
        $den += pow($x[$i] - $x_mean, 2);
    }

    $b1 = $den != 0 ? $num / $den : 0;
    $b0 = $y_mean - $b1 * $x_mean;

    $x_next = $n + 1;
    $prediksi = $b0 + $b1 * $x_next;

    return view('admin.pages.reports.prediksi_bulan', compact('monthlySales', 'b0', 'b1', 'x_next', 'prediksi'))
        ->with('page', 'report.prediksi_bulan');
}

 public function formPrediksiManual()
    {
        // Ambil total per bulan (format YYYY-MM)
        $monthlySales = DB::table('sales')
            ->selectRaw("DATE_FORMAT(date, '%Y-%m') as bulan, SUM(total) as total")
            ->where('status', 'ACTIVE')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('admin.pages.reports.prediksi_manual_form', compact('monthlySales'))
            ->with('page', 'report.prediksi_manual');
    }

    // Proses: ambil 3 bulan terpilih, hitung regresi, prediksi bulan berikutnya
    public function prosesPrediksiManual(Request $request)
    {
        $request->validate([
            'bulan1' => 'required',
            'bulan2' => 'required|different:bulan1',
            'bulan3' => 'required|different:bulan1|different:bulan2',
        ]);

        // Ambil list bulanan sekali lagi untuk lookup
        $monthlySales = DB::table('sales')
            ->selectRaw("DATE_FORMAT(date, '%Y-%m') as bulan, SUM(total) as total")
            ->where('status', 'ACTIVE')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        // Ambil profit untuk tiap bulan terpilih
        $selected = [
            $request->bulan1,
            $request->bulan2,
            $request->bulan3,
        ];
        $y = [];
        foreach ($selected as $bulan) {
            if (!isset($monthlySales[$bulan])) {
                return back()->withErrors("Data untuk bulan $bulan tidak ditemukan.");
            }
            $y[] = (float) $monthlySales[$bulan]->total;
        }

        // Hitung regresi pada X = [1,2,3]
        $x = [1,2,3];
        $x_mean = array_sum($x) / 3;
        $y_mean = array_sum($y) / 3;

        $num = 0; $den = 0;
        for ($i = 0; $i < 3; $i++) {
            $num += ($x[$i] - $x_mean) * ($y[$i] - $y_mean);
            $den += pow($x[$i] - $x_mean, 2);
        }
        $b1 = $den != 0 ? $num / $den : 0;
        $b0 = $y_mean - ($b1 * $x_mean);

        // Prediksi untuk X=4
        $x_next = 4;
        $prediksi = $b0 + $b1 * $x_next;

        // Tentukan label bulan berikutnya (setelah bulan3)
        $nextMonthLabel = Carbon::createFromFormat('Y-m', $request->bulan3)
            ->addMonth()
            ->format('F Y'); // contoh "June 2025"

        return view('admin.pages.reports.prediksi_manual_hasil', [
            'selected'       => $selected,
            'y'               => $y,
            'b0'              => $b0,
            'b1'              => $b1,
            'prediksi'        => $prediksi,
            'nextMonthLabel'  => $nextMonthLabel,
            'monthlySalesMap' => $monthlySales, // opsional jika butuh referensi
        ])->with('page', 'report.prediksi_manual');
    }
}


