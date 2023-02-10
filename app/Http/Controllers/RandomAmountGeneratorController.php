<?php

namespace App\Http\Controllers;
use Faker\Generator;
use Illuminate\Http\Request;

class RandomAmountGeneratorController extends Controller
{

    public static function randomAmount(){
        $faker = new Generator();
        $milCasas = $faker->numberBetween(1000, 100000);
        return doubleval($random = $milCasas . "." . RandomAmountGeneratorController::makeCents());
    }

    private static function makeCents(){
        $faker = new Generator();
        $cents = $faker->numberBetween(0, 99);

        if($cents < 10){
            return $returnCents = 0 . $cents;
        }

        return $cents;
    }
}
