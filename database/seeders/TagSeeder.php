<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
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
                "name"=> "Viral"
            ],
            [
                "name"=>"Medsos"
            ],
            [
                "name"=>"Mahasiswa"
            ],
            [
                "name"=>"Horror"
            ],
            [
                "name"=>"Kuliah"
            ],
            [
                "name"=>"Kerja"
            ],
            [
                "name"=>"Motivasi"
            ],
            [
                "name"=>"Loyal"
            ]
        ])->each(function($tag){
            Tag::create($tag);
        });
    }
}
