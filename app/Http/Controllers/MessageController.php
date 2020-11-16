<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Suite;
use Auth;

class MessageController extends Controller
{

  public function __construct()
  {

    $this->middleware('auth');

  }

  public function userMsgList() {

    $suites = Suite::all();
    $messages = Message::all() -> sortByDesc('created_at');
    $results = [];

    foreach ($messages as $message) {
      foreach ($suites as $suite) {
          if($message -> suite_id == $suite -> id && $suite -> user_id == Auth::user() -> id) {
            array_push($results, $message);
          }
        }
      }

    return view('user-messages-list', compact('results'));

  }

  public function destroy($id) {

    $message = Message::findOrFail($id);
    $suites = Suite::all();

      foreach ($suites as $suite) {
          if($message -> suite_id == $suite -> id && $suite -> user_id == Auth::user() -> id) {

            $message -> delete();

            return redirect() -> route('user-messages-list');
          }
        }

      return redirect() -> route('unauthorized');
  }
}
