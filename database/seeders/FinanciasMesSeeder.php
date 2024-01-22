<?php

namespace Database\Seeders;

use App\Models\FinanciasMes;
use App\Models\GastosMes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinanciasMesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FinanciasMes::factory()->count(2)->create();
    }
}
