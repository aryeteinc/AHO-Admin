<?php

namespace Database\Seeders;

use App\Models\Clasification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ClasificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $clasifications = ['Comercial','Residencial','Industrial','Rural','Turístico','Especial'];

        foreach ($clasifications as $clasification) {

            Clasification::create([
                'name' => $clasification,
                'slug' => Str::slug($clasification),
                'is_active' => true,
            ]);
        }
    }
}
