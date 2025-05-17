<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    protected $types = [
        [
            "id" => 1,
            "name" => "Listrik",
        ],
        [
            "id" => 2,
            "name" => "Air",
        ],
        [
            "id" => 3,
            "name" => "Gaji",
        ],
        [
            "id" => 4,
            "name" => "Uang makan",
        ],
        [
            "id" => 5,
            "name" => "Lain-Lain",
        ],
    ];

    public function run()
    {
        foreach ($this->types as $data) {
            ExpenseType::updateOrCreate(['id' => $data['id']], $data);
        }
    }
}
