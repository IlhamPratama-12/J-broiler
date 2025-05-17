<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $countSalesPending = Sale::where('status', 'PENDING')->where('company_id', 2)->count();
        $countSales = Sale::where('company_id', 2)->count();

        return view('admin.pages.dashboard', [
            'count_sales_pending' => $countSalesPending,
            'count_sales' => $countSales,
        ]);
    }
}
