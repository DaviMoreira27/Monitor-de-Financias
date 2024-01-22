<?php

namespace Database\Seeders;

use App\Models\TipoGasto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoGastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoGasto::factory()->count(5)->create();
        
    }
}
