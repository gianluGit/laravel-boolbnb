<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Suite;
use App\User;
use App\Visit;
use App\Message;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class GuestController extends Controller
{
  // Suite Show Details
  public function show($id) {

    $users = User::all();
    $suite = Suite::findOrFail($id);
    
    $suitesProm = Suite::join('promotion_suite', 'suites.id', '=', 'promotion_suite.suite_id') -> select('promotion_suite.*') -> get();

    $view = [

      'suite_views' => 1,
      'suite_id' => $id

    ];

    $visit = Visit::create($view);

    $timestamp = date("Y-m-d h:i:s", time());

    $activeYear = date('Y', strtotime($timestamp));
    $activeMonth = date("m", strtotime($timestamp));
    $activeDay = date("d", strtotime($timestamp));

    // Visite Globali
    $totalVisits = DB::table('visits')->where('suite_id', $id)->count();

    // Visite Giornaliere
    $dailyVisits = Visit::where('suite_id', $id)
              ->whereYear('created_at', '=', $activeYear)
              ->whereMonth('created_at', '=', $activeMonth)
              ->whereDay('created_at', '=', $activeDay)
              ->count();

    // Visite Mensili
    $monthlyVisits = Visit::where('suite_id', $id)
              ->whereYear('created_at', '=', $activeYear)
              ->whereMonth('created_at', '=', $activeMonth)
              ->count();

    // Visite Annuali
    $yearlyVisits = Visit::where('suite_id', $id)
              ->whereYear('created_at', '=', $activeYear)
              ->where('suite_id', $id)
              ->count();

    return view('show-appartment', compact('suite', 'users', 'totalVisits', 'dailyVisits', 'monthlyVisits', 'yearlyVisits', 'suitesProm'));

  }

  // Funzione di salvataggio Messaggi (liberi per tutti)
  public function store(Request $request) {

    $data = $request -> validate([

      'email_sender' => 'required|email',
      'content' => 'required|min:10|max:700',
      'suite_id' => 'required|gte:0'

    ]);

    $message = Message::create($data);
    return redirect() -> route('success');

  }

  // Funzione di ricerca in base a (Lat, Lon, Rad)
  public function getNearSuites(Request $request) {

    $data = $request -> validate([
        "search" => 'required|min:1|max:30',
        "radius" => 'required',
        "min_room_number" => 'required',
        "min_bed_number" => 'required'
    ]);

    // $allSuites = Suite::orderBy('created_at', 'DESC') -> get();
    $allSuites = Suite::join('promotion_suite', 'suites.id', '=', 'promotion_suite.suite_id') -> orderBy('promotion_suite.created_at', 'DESC') -> select('suites.*') -> get();
    $address = $request['search'];
    $response = Http::get('https://api.tomtom.com/search/2/search/<query>.json', [
      'query' => $address,
      'Key' => 'lQMhLOnxCVhfsKOBJLGi4lvALejyxLsK'
    ]);
    $answer = $response -> json();
    if($answer['summary']['numResults'] == 0) {
      $suites = [];
    } else {
      $latitude = $answer['results'][0]['position']['lat'];
      $longitude = $answer['results'][0]['position']['lon'];
      $minRoomNumber = $request['min_room_number'];
      $minBedNumber = $request['min_bed_number'];
      $radius = $request['radius'];

      $suites = Suite::selectRaw("id, title, room_number, bed_number, bathroom_number, meters, city, street, postal_code, latitude, longitude, picture, visible, user_id,
      ( 6371 * acos( cos( radians(?) ) *
      cos( radians( latitude ) )
      * cos( radians( longitude ) - radians(?)
      ) + sin( radians(?) ) *
      sin( radians( latitude ) ) )
      ) AS distance", [$latitude, $longitude, $latitude])
      ->having("distance", "<", $radius)
      ->having("room_number", ">=", $minRoomNumber)
      ->having("bed_number", ">=", $minBedNumber)
      ->having("visible", ">", 0)
      ->orderBy("distance",'asc')
      ->offset(0)
      ->limit(20)
      ->get();

    }

         return view('searched-appartment', compact('suites', 'allSuites'));

  }


}
