<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use PDF;

class AutoCompleteController extends Controller
{

    public function index(Request $request)
    {
        return view('auto-complete-city');
    }
    
}
