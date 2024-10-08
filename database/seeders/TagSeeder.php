<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $tags = [
            ['name' => 'En Calieentee', 'slug' => 'en-caliente', 'color' => '#FF2D20'],
            ['name' => 'En Oferta', 'slug' => 'en-oferta', 'color' => '#FF2D20'],
            ['name' => 'Nuevo', 'slug' => 'nuevo', 'color' => '#FF2D20'],
            ['name' => 'Popular', 'slug' => 'popular', 'color' => '#FF2D20'],
            ['name' => 'Recomendado', 'slug' => 'recomendado', 'color' => '#FF2D20'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
