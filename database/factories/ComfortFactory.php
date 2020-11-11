<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Comfort;

$factory->define(Comfort::class, function (Faker $faker) {
  return [

      'title' => $faker -> word()
      
  ];
});
