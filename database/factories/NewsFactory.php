<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // if you want generate news seeder
        // first, run php artisan tinker
        // then \App\Models\News::facrory(total_dummy_data)->create()
        return [
            'judul' => $this->faker->sentence(),
            'tag_name' => 'Viral,Medsos,Mahasiswa,Horror',
            'isi' => $this->faker->text(200),
            'gambar' => asset('assets/img/noimg.png'),
            'dilihat' => rand(0, 20),
            'user_id' => rand(1,2),
            'kategori_id' => rand(1, 8)
        ];
    }
}
