<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Http\Controllers\RandomAmountGeneratorController;
use App\Models\GastosMes;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GastosMesFactory extends Factory
{

    protected $model = GastosMes::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'idFinancias' => fake()->numberBetween(1000, 1005),
            'idTipoGasto' => fake()->numberBetween(1, 5),
            'valorGasto' => RandomAmountGeneratorController::randomAmount(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ];
    }
}
