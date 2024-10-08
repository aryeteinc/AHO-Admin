<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public $type_id;

    public function run(): void
    {
        $faker = Faker::create();
        $types = ['Apartaestudio', //1 Residencial
            'Apartamento', //1 Residencial
            'Casa', //1 Residencial
            'Casa Campestre', //4 Rural
            'Casa en Condominio', //4 Rural
            'Casa Lote',
            'Consultorio', //5 Comercial
            'Edificio', //6 Comercial
            'Finca',    //4 Rural
            'Local',
            'Lote', //4 Rural
            'Oficina', //10 Comercial
            'Parqueadero',
            'Terreno', //4 Rural
            'Bodega',
            'Cabaña'];

        foreach ($types as $type) {
            Type::create([
                'name' => $type,
                'slug' => Str::slug($type),
                'is_active' => true,
            ]);
        }
    }
}
