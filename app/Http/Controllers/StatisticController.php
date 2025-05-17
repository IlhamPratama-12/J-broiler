<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function statisticReport()
    {
        // Data dummy untuk visualisasi awal
        $categories = [
            'Beverages' => 10,
            'Condiments' => 10,
            'Confections' => 12,
            'Dairy Products' => 9,
            'Grains/Cereals' => 8,
            'Meat/Poultry' => 7,
            'Produce' => 9,
            'Seafood' => 10,
        ];

        $sales = [
            ['month' => 'Jul-1996', 'total' => 1500],
            ['month' => 'Aug-1996', 'total' => 1400],
            ['month' => 'Sep-1996', 'total' => 1100],
            ['month' => 'Oct-1996', 'total' => 1700],
            ['month' => 'Nov-1996', 'total' => 1700],
            ['month' => 'Dec-1996', 'total' => 2200],
            ['month' => 'Jan-1997', 'total' => 2400],
            ['month' => 'Feb-1997', 'total' => 800],
        ];

        $groupedSales = [
            '1996' => [
                'Beverages' => 1800,
                'Condiments' => 900,
                'Confections' => 1300,
                'Dairy Products' => 2100,
                'Grains/Cereals' => 500,
                'Meat/Poultry' => 900,
                'Produce' => 600,
                'Seafood' => 1200,
            ],
            '1997' => [
                'Beverages' => 500,
                'Condiments' => 600,
                'Confections' => 800,
                'Dairy Products' => 700,
                'Grains/Cereals' => 400,
                'Meat/Poultry' => 300,
                'Produce' => 200,
                'Seafood' => 100,
            ]
        ];

       return view('reports.statistic', compact('categories', 'sales', 'groupedSales'));

    }
}
