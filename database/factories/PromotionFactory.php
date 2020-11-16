<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Promotion;

$factory->define(Promotion::class, function (Faker $faker) {
  return [

    'name' => $faker -> word(),
    'price' => $faker -> randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
    'duration' => $faker -> randomNumber($nbDigits = 2)

  ];

});
