<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Faq;
use Faker\Generator as Faker;

$factory->define(Faq::class, function (Faker $faker) {
    return [
       'faq_question'  =>$faker->sentence($nbWords = 3, $variableNbWords = true),
       'faq_answer'    =>$faker->sentence($nbWords = 5, $variableNbWords = true)
    ];
});
