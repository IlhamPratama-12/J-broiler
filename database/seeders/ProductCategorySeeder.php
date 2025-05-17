<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $categories = [
        [
            "id" => 1,
            "name" => "AYAM SIAP PANEN PREMIUM",
            "description" => "Daging berkualitas tinggi dengan rasio daging dan lemak yang seimbang.Diproses dengan cermat untuk memastikan kebersihan dan keamanan pangan.",
        ],
        [
            "id" => 2,
            "name" => "AYAM FILLET SEGAR",
            "description" => "Potongan fillet dada dan paha ayam, tanpa tulang.Ideal untuk hidangan yang membutuhkan daging tanpa tulang berkualitas tinggi.Dikemas secara higienis untuk menjaga kebersihan dan kesegaran.",
        ],
        [
            "id" => 3,
            "name" => "AYAM POTONG KECIL",
            "description" => "Potongan ayam dengan berat lebih rendah, cocok untuk hidangan porsi individu.Tetap menyajikan kualitas dan cita rasa yang luar biasa.",
        ],
        [
            "id" => 4,
            "name" => "PRODUK SPESIAL PESANAN",
            "description" => "Menyediakan layanan khusus untuk kebutuhan spesifik pelanggan.Pengolahan sesuai dengan permintaan, termasuk potongan tertentu, kemasan, dan persyaratan lainnya.",
        ]
    ];

    public function run()
    {
        foreach ($this->categories as $data) {
            $data['slug'] = Str::slug($data['name'], '-');
            ProductCategory::updateOrCreate([
                    'id' => $data['id']
                ],
                $data + [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
