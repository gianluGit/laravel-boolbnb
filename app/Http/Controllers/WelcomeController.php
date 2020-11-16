<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suite;

class WelcomeController extends Controller
{
    // Suites nella Welcome
    public function index() {

      $randSuites = Suite::inRandomOrder() -> get();
      return view('welcome', compact('randSuites'));

    }
}
