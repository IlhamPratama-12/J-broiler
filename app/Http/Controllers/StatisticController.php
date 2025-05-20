<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
