<?php

namespace Database\Seeders;

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
    public function run()
    {
        //
        collect([
            [
                "nama" => "Aji Pamungkas",
                "alamat" => "Solo, Jawa Tengah",
                "email" => "aji@gmail.com",
                "password" => Hash::make("123")
            ],
            [
                "nama" => "Disyon",
                "alamat" => "Solo, Jawa Tengah",
                "email" => "disyon@gmail.com",
                "password" => Hash::make("123")
            ]
        ])->each(function($user){
            User::create($user);
        });
    }
}
