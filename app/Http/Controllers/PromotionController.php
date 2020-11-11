<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Promotion;
use App\Suite;
use App\User;
class PromotionController extends Controller
{
  public function __construct() {

    $this->middleware('auth');

  }
  // Checkout di Pagamento Braintree
  public function index($id) {

    $suite = Suite::findOrFail($id);
    $gateway = new \Braintree\Gateway([

      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')

    ]);

    $token = $gateway->ClientToken()->generate();

    return view('payments', [
      'token' => $token
    ], compact('suite'));

  }

  public function checkout(Request $request, $id) {

    $suite = Suite::findOrFail($id);
    $promotions = Promotion::all();
    $gateway = new \Braintree\Gateway([

      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')

    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;
    $result = $gateway->transaction()->sale([
      'amount' => $amount,
      'paymentMethodNonce' => $nonce,
      'customer' => [
        'firstName' => $suite -> id
      ],
      'options' => [
        'submitForSettlement' => true
      ]
    ]);

    if ($result->success) {
      $transaction = $result->transaction;
      foreach ($promotions as $prom) {
        if ($prom -> price == $amount) {
          $timestamp = date("Y-m-d h:i:s", time());
          $timedate = date_create($timestamp);
          switch ($amount) {
            case '2.99':
              date_add($timedate, date_interval_create_from_date_string("1 day"));
              break;
            case '5.99':
              date_add($timedate, date_interval_create_from_date_string("3 day"));
              break;
            case '9.99':
              date_add($timedate, date_interval_create_from_date_string("6 day"));
              break;
          }
          $suite -> promotions() -> attach($prom, ['end_date' => $timedate]);
        }
      }
      return redirect() -> route('show-appartment', $suite -> id);
    }
    else {
    return redirect() -> route('show-appartment', $suite -> id);
    }
  }
}
