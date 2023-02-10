<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FinanciasMes;
use App\Http\Controllers\RandomAmountGeneratorController;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinanciasMes>
 */
class FinanciasMesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FinanciasMes::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'month' => $this->faker->numberBetween(1, 12),
            'year' => $this->faker->year(),
            'gastosMes' => RandomAmountGeneratorController::randomAmount(),
            'faturamentoMes' => RandomAmountGeneratorController::randomAmount(),
            'bFinal' => RandomAmountGeneratorController::randomAmount(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ];
    }
}
