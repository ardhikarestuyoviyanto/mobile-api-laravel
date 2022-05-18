<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                "name"=> "Olahraga"
            ],
            [
                "name"=>"Pendidikan"
            ],
            [
                "name"=>"Kesenian"
            ],
            [
                "name"=>"Sejarah"
            ],
            [
                "name"=>"Politik"
            ],
            [
                "name"=>"Ekonomi"
            ],
            [
                "name"=>"Pendidikan"
            ],
            [
                "name"=>"Tokoh"
            ]
        ])->each(function($kategori){
            Kategori::create($kategori);
        });
    }
}
