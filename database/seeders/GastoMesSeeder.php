<?php

namespace Database\Seeders;

use App\Models\GastosMes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GastoMesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GastosMes::factory()->count(50)->create();
        
    }
}
