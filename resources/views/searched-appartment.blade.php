@extends('layouts.app')
@section('content')

<div class="container">
    <form class="search-app-form" action="{{route('searched-appartment')}}" method="GET">
        <label for="search">Search Appartment City:</label><br>
        <input id="city" type="text" style="width: 250px; height: 30px; padding: 10px;" name="search" value=""
            placeholder="Type city name..."><br><br>
        <label for="radius">Select Radius Distance (Km):</label><br>
        <input type="number" name="radius" value="20"><br><br>
        <label for="min_room_number">Min Rooms Number:</label>
        <select class="" name="min_room_number">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select><br>
        <label for="min_bed_number">Min Beds Number:</label>
        <select class="" name="min_bed_number">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select><br><br>
        <button class="searched-app-button btn" style="cursor: pointer;" type="submit" name="button"> <i
                class="fa fa-search"></i> Search</button>
        <br><br><br>
        <span style="font-weight: 800">Comfrot Filters: </span> <br>
        <div id="checkboxes">
            <div class="comfort-check">
                <input id="wifi" type="checkbox" name="comfort" value="wifi">
                ​<label for="wifi">Wi-Fi</label>
            </div>
            <div class="comfort-check">
                <input id="parking" type="checkbox" name="comfort" value="parking">
                ​<label for="parking">Parking</label>
            </div>
            <div class="comfort-check">
                <input id="pool" type="checkbox" name="comfort" value="pool">
                ​<label for="pool">Pool</label>
            </div>
            <div class="comfort-check">
                <input id="reception" type="checkbox" name="comfort" value="reception">
                ​<label for="reception">Reception</label>
            </div>
            <div class="comfort-check">
                <input id="sauna" type="checkbox" name="comfort" value="sauna">
                ​<label for="sauna">Sauna</label>
            </div>
            <div class="comfort-check">
                <input id="seaview" type="checkbox" name="comfort" value="seaview">
                ​<label for="seaview">Sea-view</label>
            </div>
            <div class="comfort-check">
                <input id="massage" type="checkbox" name="comfort" value="massage">
                ​<label for="massage">Massage</label>
            </div>
            <div class="comfort-check">
                <input id="solarium" type="checkbox" name="comfort" value="solarium">
                ​<label for="solarium">Solarium</label>
            </div>
            <div class="comfort-check">
                <input id="sport" type="checkbox" name="comfort" value="sport">
                ​<label for="sport">Sport</label>
            </div>
            <div class="comfort-check">
                <input id="golf" type="checkbox" name="comfort" value="golf">
                ​<label for="golf">Golf</label>
            </div>
        </div>
    </form>
</div>​
​
<div class="container">
  <div class="search-app-cards">
    <h5 style="font-weight: 800;"><i class="fa fa-star" aria-hidden="true" style="color: #ff385c;"></i> Promoted Appartments:</h5>
    @php
      $count = 0;
    @endphp
    @foreach ($allSuites as $allSuite)
        @php
          if ($count == 2) break;
        @endphp
        <div class="card row" style="background-color: #ffd93812;">
          <div class="searched-app-details-img">
            <a href="{{ route('show-appartment', $allSuite -> id) }}"><img src="{{ asset('storage/'. $allSuite -> picture) }}" alt=""></a>
          </div>
          <div class="searched-app-details-li">
            <ul>
              <li>Id: <b>{{ $allSuite -> id }}</b></li>
              <li>Title: <b>{{ $allSuite -> title }}</b></li>
              <li>Available rooms: <b>{{ $allSuite -> room_number }}</b></li>
              <li>Beds number: <b>{{ $allSuite -> bed_number }}</b></li>
              <li>Square Meters: <b>{{ $allSuite -> meters }}</b></li>
              <li>City: <b>{{ $allSuite -> city }}</b></li>
              <li>Postal Code: <b>{{ $allSuite -> postal_code }}</b></li>
              <li class="comforts
              @foreach ($allSuite -> comforts as $cmf)
                {{$cmf -> title}}
              @endforeach">Comforts: <br>
              @foreach ($allSuite -> comforts as $cmf)
                <span>
                  <b>
                    <i class="fa fa-check"></i>
                    {{$cmf -> title}}
                  </b>
                </span>
              @endforeach
            </li>
          </ul>
        </div>
        <div class="btn-show-details-search">
          <a href="{{ route('show-appartment', $allSuite -> id) }}"><button type="button" class="details-btn btn btn-success"><i
            class="fa fa-eye" aria-hidden="true"></i> View Details</button></a>
          </div>
        </div>
        @php
          $count++;
        @endphp
    @endforeach
  </div><br>

    <div class="search-app-cards">
      <h5 style="font-weight: 800;"><i class="fa fa-location-arrow" aria-hidden="true" style="color: #ff385c;"></i> Near Appartments:</h5>
        @foreach ($suites as $suite)
        <div class="card row" style="padding-top: 25px;">
            <div class="searched-app-details-img">
              <a href="{{ route('show-appartment', $suite -> id) }}"><img src="{{ asset('storage/'. $suite -> picture) }}" alt=""></a>
            </div>
            <div class="searched-app-details-li">
                <ul>
                    <li>Id: <b>{{ $suite -> id }}</b></li>
                    <li>Title: <b>{{ $suite -> title }}</b></li>
                    <li>Available rooms: <b>{{ $suite -> room_number }}</b></li>
                    <li>Beds number: <b>{{ $suite -> bed_number }}</b></li>
                    <li>Square Meters: <b>{{ $suite -> meters }}</b></li>
                    <li>City: <b>{{ $suite -> city }}</b></li>
                    <li>Postal Code: <b>{{ $suite -> postal_code }}</b></li>
                    <li class="comforts
                    @foreach ($suite -> comforts as $cmf)
                    {{$cmf -> title}}
                    @endforeach">Comforts: <br>

                    @foreach ($suite -> comforts as $cmf)
                    <span>
                        <b>
                            <i class="fa fa-check"></i>
                         {{$cmf -> title}}
                         </b>
                    </span>
                    @endforeach
                    </li>
                </ul>

            </div>

           <div class="btn-show-details-search">
            <a href="{{ route('show-appartment', $suite -> id) }}"><button type="button" class="details-btn btn btn-success"><i
                class="fa fa-eye" aria-hidden="true"></i> View Details</button></a>
           </div>

        </div>

        @endforeach
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FyaT6jXKAH42SKiBUpVZb0ip4OKxY2Y&libraries=places&v=3.exp">
</script>
<script type="text/javascript">
function initialize() {
    var options = {
        types: ['(cities)'],
        componentRestrictions: {
            country: "it"
        }
    };
    var input = document.getElementById('city');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
​
@endsection
