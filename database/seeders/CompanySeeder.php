<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    protected $companies = [
        [
            "id" => 1,
            "name" => "PT FL MANDIRI SEJAHTRA",
            "address" => "JALAN MONGISIDI 2, KELURAHAN BONTO SUNGGU, KEC. BISSAPPU, KABUPATEN BANTAENG, SULAWESI SELATAN 92451",
            "phone" => "+6282193244214",
            "is_selected" => true
        ],
        [
            "id" => 2,
            "name" => "CV. Dian Latippa",
            "address" => "JALAN MONGISIDI 2, KELURAHAN BONTO SUNGGU, KEC. BISSAPPU, KABUPATEN BANTAENG, SULAWESI SELATAN 92451",
            "phone" => "+6282193244214",
            "is_selected" => false
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->companies as $data) {
            Company::updateOrInsert([
                    'id' => $data['id']
                ],
                $data
            );
        }
    }
}
