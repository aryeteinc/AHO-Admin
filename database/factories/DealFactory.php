<?php

namespace Database\Factories;

use App\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DealFactory extends Factory
{
    protected $model = Deal::class;


    public function definition(): array
    {

        return [
            'name' => $this->faker->name(),
            'slug' => Str::slug($this->faker->name()),
            'is_active' => true,
        ];
    }
}
