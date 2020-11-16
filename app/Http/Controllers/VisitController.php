<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Suite;
use DB;

class VisitController extends Controller
{
  public function __construct()
  {

    $this->middleware('auth');

  }
  // Pagina Stats di una Suite
  public function showStats($id)
  {

    $suite = Suite::findOrFail($id);

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

    $dailyData = [ ];
    $dayarray = [ ];

    if ( $activeMonth == '11' || $activeMonth == '04' || $activeMonth == '06' || $activeMonth == '09') {
      for ($i=1; $i <=30 ; $i++) {
        $day = Visit::where('suite_id', $id)
        ->whereYear('created_at', '=', $activeYear)
        ->whereMonth('created_at', '=', $activeMonth)
        ->whereDay('created_at', '=', $i)
        ->count();
        array_push($dayarray, $i . ',');
        array_push($dailyData, $day . ',');
      }
    } elseif ($activeMonth == '02') {
      for ($i=1; $i <=28 ; $i++) {
        $day = Visit::where('suite_id', $id)
        ->whereYear('created_at', '=', $activeYear)
        ->whereMonth('created_at', '=', $activeMonth)
        ->whereDay('created_at', '=', $i)
        ->count();
        array_push($dayarray, $i . ',');
        array_push($dailyData, $day . ',');
      }
    } else {
      for ($i=1; $i <=31 ; $i++) {
        $day = Visit::where('suite_id', $id)
        ->whereYear('created_at', '=', $activeYear)
        ->whereMonth('created_at', '=', $activeMonth)
        ->whereDay('created_at', '=', $i)
        ->count();
        array_push($dayarray, $i . ',');
        array_push($dailyData, $day . ',');
    }
  }
    // Visite Mensili
    $monthlyVisits = Visit::where('suite_id', $id)
              ->whereYear('created_at', '=', $activeYear)
              ->whereMonth('created_at', '=', $activeMonth)
              ->count();

    $monthsData = [ ];

              for ($i=1; $i <=12 ; $i++) {
              $month = Visit::where('suite_id', $id)
              ->whereYear('created_at', '=', $activeYear)
              ->whereMonth('created_at', '=', $i)
              ->count();
              array_push($monthsData, $month . ',');
              }
    // Visite Annuali
    $yearlyVisits = Visit::where('suite_id', $id)
              ->whereYear('created_at', '=', $activeYear)
              ->where('suite_id', $id)
              ->count();

    return view('stats-appartment', compact('suite', 'totalVisits', 'dailyVisits','dailyData', 'dayarray', 'monthlyVisits', 'monthsData', 'yearlyVisits'));
  }

}
