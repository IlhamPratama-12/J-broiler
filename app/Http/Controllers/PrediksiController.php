<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrediksiController extends Controller
{
    // Tampilkan form input prediksi manual (berdasarkan bulan Januari-Desember)
    public function form()
     {
        $start = Carbon::create(2024, 6, 1);
        $endDate = DB::table('sales')
            ->selectRaw('MAX(date) as latest_date')
            ->value('latest_date');

        if (!$endDate) {
            return back()->withErrors(['data' => 'Tidak ada data penjualan.']);
        }

        $end = Carbon::parse($endDate)->startOfMonth();

        $bulanList = [];
        while ($start->lessThanOrEqualTo($end)) {
            $bulanList[] = [
                'value' => $start->format('Y-m'),
                'label' => $start->translatedFormat('F Y'),
            ];
            $start->addMonth();
        }

        return view('admin.pages.reports.prediksi_manual_form', [
            'months' => $bulanList,
        ])->with('page', 'prediksi_bulan');
    }

    // Proses prediksi dari data sale_details
    public function processPrediksi(Request $request)
     {
        $request->validate([
            'bulan_prediksi' => 'required|date_format:Y-m',
        ]);

        $bulanPrediksi = $request->input('bulan_prediksi');
        $carbonPrediksi = Carbon::createFromFormat('Y-m', $bulanPrediksi);

        $dataPenjualan = [];
        for ($i = 6; $i >= 1; $i--) {
            $bulan = $carbonPrediksi->copy()->subMonths($i);

            $produk = DB::table('sale_details')
                ->join('sales', 'sales.id', '=', 'sale_details.sale_id')
                ->join('products', 'products.id', '=', 'sale_details.product_id')
                ->select(
                    'products.name',
                    DB::raw('SUM(sale_details.qty) as total_qty'),
                    DB::raw('SUM(sale_details.subtotal) as total')
                )
                ->whereYear('sales.date', $bulan->year)
                ->whereMonth('sales.date', $bulan->month)
                ->where('sales.status', 'ACTIVE')
                ->groupBy('products.name')
                ->orderByDesc('total')
                ->get();

            $dataPenjualan[] = [
                'bulan' => $bulan->format('Y-m'),
                'total' => $produk->sum('total'),
                'produk' => $produk,
            ];
        }

         if (collect($dataPenjualan)->sum('total') == 0) {
            return back()->withErrors(['bulan_prediksi' => 'Data penjualan 6 bulan sebelumnya tidak ditemukan.'])->withInput();
        }

        $x = range(1, 6);
        $y = array_column($dataPenjualan, 'total');

        // Hitung total qty per bulan
        $y_qty = [];
        foreach ($dataPenjualan as $data) {
            $qty = 0;
            foreach ($data['produk'] as $produk) {
                $qty += $produk->total_qty;
            }
            $y_qty[] = $qty;
        }

        $n = count($x);
        $avgX = array_sum($x) / $n;
        $avgY = array_sum($y) / $n;
        $avgY_qty = array_sum($y_qty) / $n;

        $varX = 0;
        $covXY = 0;
        $covXY_qty = 0;

        for ($i = 0; $i < $n; $i++) {
            $varX += pow($x[$i] - $avgX, 2);
            $covXY += ($x[$i] - $avgX) * ($y[$i] - $avgY);
            $covXY_qty += ($x[$i] - $avgX) * ($y_qty[$i] - $avgY_qty);
        }

        $b1 = $varX == 0 ? 0 : $covXY / $varX;
        $b0 = $avgY - $b1 * $avgX;
        $prediksi = max(0, $b0 + $b1 * 7);

        $b1_qty = $varX == 0 ? 0 : $covXY_qty / $varX;
        $b0_qty = $avgY_qty - $b1_qty * $avgX;
        $prediksi_qty = max(0, round($b0_qty + $b1_qty * 7));

        return view('admin.pages.reports.prediksi_manual_hasil', [
            'monthlySales' => $dataPenjualan,
            'b0' => $b0,
            'b1' => $b1,
            'prediksi' => $prediksi,
            'prediksi_qty' => $prediksi_qty,
            'x_next' => 7,
            'bulan_prediksi' => $bulanPrediksi,
        ])->with('page', 'prediksi_bulan');
    }
}
