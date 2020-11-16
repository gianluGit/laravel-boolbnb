<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Auth;
use App\Suite;
use App\User;
use App\Comfort;

class SuiteController extends Controller
{

    public function __construct()
    {

      $this->middleware('auth');

    }
    // Creazione Suite
    public function create() {

      $users = User::all();
      return view('create-appartment', compact('users'));

    }
    // Salvataggio Immagine
    protected function storeImage(Request $request) {

      $path = $request->file('picture')->store('public/profile');
      return substr($path, strlen('public/'));

    }
    // Immissione Suite nel DB
    public function store(Request $request) {

      $data = $request -> validate([

        'title' => 'required|min:3|max:35',
        'room_number' => 'required|gte:0|max:99',
        'bed_number' => 'required|gte:0|max:20',
        'bathroom_number' => 'required|gte:0|max:20',
        'meters' => 'required|gte:0|max:1000',
        'city' => 'required|min:3|max:50',
        'street' => 'required|min:3|max:50',
        'postal_code' => 'required|min:3|max:30',
        'latitude' => 'required',
        'longitude' => 'required',
        'picture' => 'nullable|min:3|max:5000',
        'visible' => 'required|min:1|max:1',
        'user_id' => 'required|gte:0',
        'wifi',
        'parking',
        'pool',
        'reception',
        'sauna',
        'seaview',
        'massage',
        'solarium',
        'sport',
        'golf'

      ]);

      // Generazione URL relativo all'immagine della Suite
      $imageUrl = $this->storeImage($request);
      $data = $request -> all();
      $data['picture'] = $imageUrl;

      // Traduzione Indirizzo -> Latitudine, Longitudine
      $city = $data['city'];
      $postal_code = $data['postal_code'];
      $street = $data['street'];

      // GuzzleHttp API Call
      $response = Http::get('https://api.tomtom.com/search/2/search/<query>.json', [
        'query' => $city . ' ' . $postal_code . ' ' . $street,
        'Key' => 'lQMhLOnxCVhfsKOBJLGi4lvALejyxLsK',
      ]);

      $answer = $response -> json();

      $data['latitude'] = $answer['results'][0]['position']['lat'];
      $data['longitude'] = $answer['results'][0]['position']['lon'];

      $suite = Suite::create($data);

      $comforts = [];

      array_push($comforts, isset($data['wifi']) ? $data['wifi'] : null,
                            isset($data['parking'] ) ? $data['parking'] : null,
                            isset($data['pool'] ) ? $data['pool'] : null,
                            isset($data['reception']) ? $data['reception'] : null,
                            isset($data['seaview']) ? $data['seaview'] : null,
                            isset($data['sauna']) ? $data['sauna'] : null,
                            isset($data['massage']) ? $data['massage'] : null,
                            isset($data['solarium']) ? $data['solarium'] : null,
                            isset($data['sport']) ? $data['sport'] : null,
                            isset($data['golf']) ? $data['golf'] : null

                );

      foreach ($comforts as $comfort) {

        $suite -> comforts() -> attach($comfort);

      }

      return redirect() -> route('user-appartments-list');

    }
    // Modifica Suite
    public function edit($id) {

          $suite = Suite::findOrFail($id);

          if($suite -> user_id == Auth::user() -> id) {
            // Serve per portarsi i Comforts nella edit
            $comforts = Comfort::all();
            return view('edit-appartment', compact('suite', 'comforts'));
          } else {
            return view('unauthorized');
          }

        }
    // Aggiorna Suite nel DB
    public function update(Request $request, $id) {

      $data = $request -> validate([

        'title' => 'required|min:3|max:50',
        'room_number' => 'required|gte:0|max:99',
        'bed_number' => 'required|gte:0|max:20',
        'bathroom_number' => 'required|gte:0|max:20',
        'meters' => 'required|gte:0|max:1000',
        'city' => 'required|min:3|max:50',
        'street' => 'required|min:3|max:50',
        'postal_code' => 'required|min:3|max:30',
        'latitude' => 'required',
        'longitude' => 'required',
        'picture' => 'nullable|min:3|max:5000',
        'visible' => 'required|min:1|max:1',
        'user_id' => 'required|gte:0',
        'wifi',
        'parking',
        'pool',
        'reception',
        'sauna',
        'seaview',
        'massage',
        'solarium',
        'sport',
        'golf'

      ]);

      $suite = Suite::findOrFail($id);

      if($suite -> user_id == Auth::user() -> id) {

        // Generazione URL relativo all'immagine della Suite
        if($request->hasfile('picture')) {
          $imageUrl = $this->storeImage($request);
          $data = $request -> all();
          $data['picture'] = $imageUrl;
        }

        // Traduzione Indirizzo -> Latitudine, Longitudine
        $city = $data['city'];
        $postal_code = $data['postal_code'];
        $street = $data['street'];

        // GuzzleHttp API Call
        $response = Http::get('https://api.tomtom.com/search/2/search/<query>.json', [
          'query' => $city . ' ' . $postal_code . ' ' . $street,
          'Key' => 'lQMhLOnxCVhfsKOBJLGi4lvALejyxLsK',
        ]);

        $answer = $response -> json();

        $data['latitude'] = $answer['results'][0]['position']['lat'];
        $data['longitude'] = $answer['results'][0]['position']['lon'];

        $suite -> update($data);

        // Associa i Comforts alla Suite in maniera dinamica tramite il sync
        $suite -> comforts() -> sync($request -> get('comforts', []));
        // get() prende i cmf dalla tabella ponte, li inserisce in un array, li confronta con quelli della request e tramite il sync, li adegua

        return redirect() -> route('show-appartment', $suite -> id);

      } else {
        return view('unauthorized');
      }


    }
    // Eliminazione Suite
    public function destroy($id) {

      $suite = Suite::findOrFail($id);

      if($suite -> user_id == Auth::user() -> id) {

        $suite -> comforts() -> sync([]);
        $suite -> delete();

        return redirect() -> route('user-appartments-list');

      } else {
        return view('unauthorized');
      }


    }
    // Lista delle Suites di un utente
    public function userAppList() {

      $suites = Suite::all();
      return view('user-appartments-list', compact('suites'));

    }

}
