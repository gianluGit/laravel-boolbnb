@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Appartment Details') }} - <u> ID: {{ $suite -> id }} </u></div>
                <div class="card-body">
                  <form action="{{ route('update-appartment', $suite -> id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <label for="title">Title: </label> <br>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $suite -> title }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="room_number">Available rooms: </label> <br>
                    <input type="number" class="form-control @error('room_number') is-invalid @enderror" name="room_number" value="{{ $suite -> room_number }}">
                    @error('room_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="bed_number">Beds number: </label> <br>
                    <input type="number" class="form-control @error('bed_number') is-invalid @enderror" name="bed_number" value="{{ $suite -> bed_number }}">
                    @error('bed_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="bathroom_number">Bathroom number: </label> <br>
                    <input type="number" class="form-control @error('bathroom_number') is-invalid @enderror" name="bathroom_number" value="{{ $suite -> bathroom_number }}">
                    @error('bathroom_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="meters">Square Meters: </label> <br>
                    <input type="number" class="form-control @error('meters') is-invalid @enderror" name="meters" value="{{ $suite -> meters }}">
                    @error('meters')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="city">City: </label> <br>
                    <input id="editCity" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $suite -> city }}">
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="street">Street: </label> <br>
                    <input id="editStreet" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $suite -> street }}">
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="postal_code">Postal Code: </label> <br>
                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ $suite -> postal_code }}">
                    @error('postal_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <label for="latitude" style="display: none">Latitude: </label>
                    <input type="text" name="latitude" value="{{ $suite -> latitude }}" style="display: none">
                    <label for="longitude" style="display: none">Longitude: </label>
                    <input type="text" name="longitude" value="{{ $suite -> longitude }}" style="display: none">
                    <label for="visible">Visible on Search: </label> <br>
                    <select name="visible">
                      <option value="1">Yes</option>
                      <option value="0" @if($suite -> visible == 0) selected @endif>No</option>
                    </select>
                    <label for="user_id" style="display: none;">User-id: </label>
                    <input id="user_id" style="display: none;" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="@auth {{ Auth::user() -> id }} @else 0 @endauth" required autocomplete="user_id">
                    @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br> <br>
                    <label for="picture">Picture: </label> <br>
                    <input type="file" class="form-control @error('picture') is-invalid @enderror" name="picture" value="{{ $suite -> picture }}">
                    @error('picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    {{-- Ricostruzione checkbox in maniera dinamica  --}}
                    <div class="form-group row col-md-12">
                        <span style="font-weight: 800">Comfort Filters: </span>
                     <br>
                      <div id="checkboxes">

                           @foreach ($comforts as $comfort)
                           <div class="comfort-check">
                           <input type="checkbox" name="comforts[]" id="{{ $comfort->id }}" value="{{ $comfort->id }}"
                           {{ in_array($comfort->id, $suite->comforts
                           ->pluck('id')
                           ->toArray())  ? 'checked' : '' }}>
                           <label for="{{ $comfort->id }}"> {{ $comfort-> title }} </label>
                           </div>
                            @endforeach

                      </div>
                    </div>
                    {{-- Fine blocco checkbox --}}
                    <img src="{{ asset('storage/'. $suite -> picture) }}" alt="room_picture" onError="this.onerror=null;this.src='{{ asset('images/roomdef.png') }}';" width="250px" height="auto"><br><br><br>
                    <button id="editBtn" type="submit" class="btn" style="color: white;">UPDATE</button>
                  </form><br>
                  <div class="back-homepage-btn" style="width: 150px">
                      <a href="{{ route('user-appartments-list') }}">
                          <i class="fa fa-reply"></i>
                          Back to my Suites
                      </a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FyaT6jXKAH42SKiBUpVZb0ip4OKxY2Y&libraries=places&v=3.exp"></script>
<script type="text/javascript">
  function initialize() {
      var optionsCity = {
          types: ['(cities)'],
          componentRestrictions: {
              country: "it"
          }
      };
      var inputCity = document.getElementById('editCity');
      var autocomplete = new google.maps.places.Autocomplete(inputCity, optionsCity);
      var optionsAddr = {
          types: ['address'],
          componentRestrictions: {
              country: "it"
          }
      };
      var inputStreet = document.getElementById('editStreet');
      var autocomplete = new google.maps.places.Autocomplete(inputStreet, optionsAddr);
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

@endsection
