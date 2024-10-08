<?php

namespace Database\Seeders;

use App\Models\Deal;
use App\Models\Status;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\DealFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

//Usar faker
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $name_deal = ['Venta', 'Arriendo', 'Permuta', 'Venta-Arriendo', 'Permuta-Venta', 'Permuta-Arriendo'];

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'aryeteinc@hotmail.com',
            'password' => bcrypt('288Paq03*'),
        ]);

        foreach ($name_deal as $deal) {
            Deal::factory()->create([
                'name' => $deal,
                'slug' => Str::slug($deal),
                'is_active' => true,
            ]);
        }

        Status::factory()->create([
            'name' => 'Nuevo',
            'slug' => 'nuevo',
        ]);

        Status::factory()->create([
            'name' => 'Usado',
            'slug' => 'usado',
        ]);

        $this->call([
            DepartmentSeeder::class,
            CitySeeder::class,
            ClasificationSeeder::class,
            TypeSeeder::class,
            DetailSeeder::class,
            TagSeeder::class,
        ]);
    }
}
