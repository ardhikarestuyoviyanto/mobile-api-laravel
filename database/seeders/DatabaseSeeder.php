<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // run seeder
        $this->call([
            // KategoriSeeder::class,
            // TagSeeder::class,
            // if you want generate user uncomment this
            UserSeeder::class
        ]);
    }
}
