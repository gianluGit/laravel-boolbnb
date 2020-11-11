@extends('layouts.app')
@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center search-appartament-container">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Appartment Details') }}</div>
                    <div class="card-body">
                        <ul>
                            <li>Title: <b>{{ $suite -> title }}</b></li>
                            <li>Available rooms: <b>{{ $suite -> room_number }}</b></li>
                            <li>Beds number: <b>{{ $suite -> bed_number }}</b></li>
                            <li>Bathroom number: <b>{{ $suite -> bathroom_number }}</b></li>
                            <li>Square Meters: <b>{{ $suite -> meters }}</b></li>
                            <li>City: <b>{{ $suite -> city }}</b></li>
                            <li>Postal Code: <b>{{ $suite -> postal_code }}</b></li>
                            <li>Apparment Owner: <b>{{ $suite -> user -> firstname }} {{ $suite -> user -> lastname }}</b>
                            <li>Comforts List:
                                @foreach ($suite -> comforts as $cmf)
                                <i style="color: #ff385c" class="fa fa-check"></i> {{ $cmf -> title }} |
                                @endforeach
                            </li>
                            </li>
                            @auth
                            @if ($suite -> user_id == Auth::user() -> id)
                            <li>
                                In promotion for:
                                @foreach ($suite -> promotions as $prom)
                                <span style="color: green; font-weight: bold;"><i class="fa fa-clock-o" style="color: green;" aria-hidden="true"></i> {{$prom -> name}} </span>
                                @endforeach
                            </li>
                            @endif
                            @endauth
                        </ul>
                        @auth
                        @if ($suite -> user_id == Auth::user() -> id)
                        <center>
                            <span>Overall Visits: <b> {{ $totalVisits }} </b></span><br>

                            <a href="{{ route('show-stats', $suite -> id) }}" style="text-decoration: none; border: none; color: white;" class="btn btn-primary">
                              <i class="fa fa-bar-chart" aria-hidden="true"></i> View Suite Stats
                            </a>

                            <a href="{{ route('payment-index', $suite -> id) }}" style="text-decoration: none; border: none; color: white;" class="btn btn-success">
                              <i class="fa fa-usd" aria-hidden="true"></i> Promote Appartment
                            </a>

                        </center><br><br>
                        @endif
                        @endauth
                        <center class="show-img"><img src="{{ asset('storage/'. $suite -> picture) }}" alt="room_picture" onError="this.onerror=null;this.src='{{ asset('images/roomdef.png') }}';" width="250px"
                              height="auto"><br><span><em>{{ $suite -> title }} picture.</em></span></center>
                        <hr>
                        <b>Appartment Map Placement:</b><br> <br>
                        <!-- Div contenente la Mappa Google -->
                        <div id="map">
                        </div>
                        <hr>
                        <b>Contact the Appartment Owner:</b><br><br>
                        <form class="" action="{{ route('store-message') }}" method="post">
                            @csrf
                            @method('POST')
                            <label for="email_sender">
                                Your email:
                            </label>
                            <br>
                            <input type="email" class="form-control @error('email_sender') is-invalid @enderror"
                            name="email_sender" value="
                            @auth {{ Auth::user() -> email }}
                            @endauth"
                            placeholder="Your email address"><br>
                            @error('email_sender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="content">Message body:</label><br>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                            value="" placeholder="Type your message here"></textarea><br>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="suite_id" style="display: none">Suite ID:</label>
                            <input type="number" class="form-control @error('suite_id') is-invalid @enderror"
                            name="suite_id" value="{{ $suite -> id }}" style="display: none"></input>
                            @error('suite_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <span id="mapLat" style="display: none">{{ $suite -> latitude }}</span>
                            <span id="mapLon" style="display: none">{{ $suite -> longitude }}</span>
                            <div class="container">
                                <div class="row justify-content-between">
                                    <button class="send message btn white-txt" type="submit" name="button">Send Message</button>
                                    <div class="back-homepage-btn">
                                        <a href="{{ route('welcome') }}">
                                            <i class="fa fa-reply"></i>
                                            Back to HomePage
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FyaT6jXKAH42SKiBUpVZb0ip4OKxY2Y&callback=initMap&libraries=&v=weekly" defer></script>
<script type="text/javascript">
    function initMap() {
        // Prendo il valore dei 2 span (display: none) che uso solo per catturare latitudine e longitudine della suite dal DB (model)
        var mapLat = parseFloat($('#mapLat').html()); // parseFloat per convertire la stringa in un float number
        var mapLng = parseFloat($('#mapLon').html());
        console.log(mapLat);
        // Li salvo in un object
        const appartmentMap = {
            lat: mapLat,
            lng: mapLng
        };
        // Creo la mappa puntata su appartmentMap
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: appartmentMap,
        });
        // Posiziono l'indicatore rosso sul punto indicato da Lat-Lon
        const marker = new google.maps.Marker({
            position: appartmentMap,
            map: map,
        });
    }
</script>

@endsection
