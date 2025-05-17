<?php

namespace Database\Seeders;

use DB;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $user = [
        [
            "id" => 1,
            "name" => "Developer",
            "username" => "developer",
            "password" => "developer100%",
            "is_admin" => true
        ],
        [
            "id" => 2,
            "name" => "Admin",
            "username" => "admin",
            "password" => "admin100%",
            "is_admin" => true
        ],
        [
            "id" => 3,
            "name" => "Owner",
            "username" => "owner",
            "password" => "owner100%",
            "is_admin" => true
        ],
        [
            "id" => 4,
            "name" => "Fadel07",
            "username" => "fadel07",
            "password" => "fadel07",
            "is_admin" => true
        ],
        [
            "id" => 5,
            "name" => "Kasir",
            "username" => "kasir",
            "password" => "kasir123",
            "is_admin" => false,
        ]
    ];

    public function run()
    {
        foreach ($this->user as $data) {
            $data['password'] = Hash::make($data['password']);
            User::updateOrCreate([
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
