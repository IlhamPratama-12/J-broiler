<?php

namespace Database\Seeders;

use App\Models\SaleStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleStatusSeeder extends Seeder
{
    protected $types = [
        [
            "id" => 1,
            "name" => "ACTIVE",
        ],
        [
            "id" => 2,
            "name" => "PENDING",
        ],
        [
            "id" => 3,
            "name" => "CANCEL",
        ],
    ];

    public function run()
    {
        foreach ($this->types as $data) {
            SaleStatus::updateOrCreate(['id' => $data['id']], $data);
        }
    }
}
