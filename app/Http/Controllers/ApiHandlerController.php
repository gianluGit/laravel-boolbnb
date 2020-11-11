<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Suite;

class ApiHandlerController extends Controller
{

    // --------------- [ Get request ] -----------------------
    public function getCoordinates() {

      $city = 'Langhirano';
      $postal_code = '43013';
      $street = 'Via Cascinapiano';

      $response = Http::get('https://api.tomtom.com/search/2/search/<query>.json', [
        'query' => $city . ' ' . $postal_code . ' ' . $street,
        'Key' => 'lQMhLOnxCVhfsKOBJLGi4lvALejyxLsK',
      ]);

      $answer = $response -> json();

      $coor['lat'] = $answer['results'][0]['position']['lat'];
      $coor['lon'] = $answer['results'][0]['position']['lon'];

      dd($answer);

    }

    public function getNearSuites() {

      // $data = $request -> all();
      $city = 'Parma';
      $radius = 100;

      $response = Http::get('https://api.tomtom.com/search/2/search/<query>.json', [
        'query' => $city,
        'Key' => 'lQMhLOnxCVhfsKOBJLGi4lvALejyxLsK',
      ]);

      $answer = $response -> json();

      $latitude = $answer['results'][0]['position']['lat'];
      $longitude = $answer['results'][0]['position']['lon'];

      $suites = Suite::selectRaw("id, title, latitude, longitude,
                         ( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance", [$latitude, $longitude, $latitude])
            // ->where('active', '=', 1)
            ->having("distance", "<", $radius)
            ->orderBy("distance",'asc')
            ->offset(0)
            ->limit(20)
            ->get();

            return response() -> json($suites);
            dd($suites);
    }
}
