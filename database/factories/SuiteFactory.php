<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Suite;

$factory->define(Suite::class, function (Faker $faker) {
    return [

      'title' => $faker -> word(),
      'room_number' => $faker -> randomDigit(),
      'bed_number' => $faker -> randomDigit(),
      'bathroom_number' => $faker -> randomDigit(),
      'meters' => $faker -> randomNumber($nbDigits = 3),
      'city' => $faker -> city(),
      'street' => $faker -> streetName(),
      'postal_code' => $faker -> postcode(),
      'latitude' => $faker -> latitude($min = -90, $max = 90),
      'longitude' => $faker -> longitude($min = -180, $max = 180),
      'picture' => $faker -> url(),
      'visible' => $faker -> boolean()

    ];
});
