<?php

namespace Database\Factories;

use App\Models\TipoGasto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoGasto>
 */
class TipoGastoFactory extends Factory
{

    protected $model = TipoGasto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nomeGasto' => fake()->text(30),
            'tipoGasto' => fake()->text(30),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ];
    }
}
