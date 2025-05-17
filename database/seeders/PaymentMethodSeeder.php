<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    protected $methods = [
        [
            "id" => 1,
            "name" => "CASH",
            "display_name" => "Tunai"
        ],
        [
            "id" => 2,
            "name" => "TRANSFER",
            "display_name" => "Transfer",
        ],
        [
            "id" => 3,
            "name" => "DEBIT/CREDIT",
            "display_name" => "Debit/Kredit",
        ],
    ];


    public function run()
    {
        foreach ($this->methods as $data) {
            PaymentMethod::updateOrCreate(['id' => $data['id']], $data);
        }
    }
}
