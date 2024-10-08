<?php

namespace Database\Factories;

use App\Models\Clasification;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClasificationFactory extends Factory
{
    protected $model = Clasification::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'is_active' => $this->faker->boolean,
            //'type_id' => $this->faker->randomElement([5, 6, 10]),
        ];
    }
}
