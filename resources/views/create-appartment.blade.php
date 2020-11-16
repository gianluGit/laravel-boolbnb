@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Create New Appartment') }}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('store-appartment') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="room_number" class="col-md-4 col-form-label text-md-right">{{ __('Room Number') }}</label>
                            <div class="col-md-6">
                                <input id="room_number" type="number" class="form-control @error('room_number') is-invalid @enderror" name="room_number" value="{{ old('room_number') }}" required autocomplete="room_number" autofocus>
                                @error('room_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bed_number" class="col-md-4 col-form-label text-md-right">{{ __('Bed Number') }}</label>
                            <div class="col-md-6">
                                <input id="bed_number" type="number" class="form-control @error('bed_number') is-invalid @enderror" name="bed_number" value="{{ old('bed_number') }}" required autocomplete="bed_number" autofocus>
                                @error('bed_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bathroom_number" class="col-md-4 col-form-label text-md-right">{{ __('Bathroom Number') }}</label>
                            <div class="col-md-6">
                                <input id="bathroom_number" type="number" class="form-control @error('bathroom_number') is-invalid @enderror" name="bathroom_number" value="{{ old('bathroom_number') }}" required autocomplete="bathroom_number">
                                @error('bathroom_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meters" class="col-md-4 col-form-label text-md-right">{{ __('Meters') }}</label>
                            <div class="col-md-6">
                                <input id="meters" type="number" class="form-control @error('meters') is-invalid @enderror" name="meters" value="{{ old('meters') }}" required autocomplete="meters">
                                @error('meters')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>
                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="street">
                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postal Code') }}</label>
                            <div class="col-md-6">
                                <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code">
                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="display: none">
                            <label for="latitude" class="col-md-4 col-form-label text-md-right">{{ __('Latitude') }}</label>
                            <div class="col-md-6">
                                <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="00.00000000" required autocomplete="latitude">
                                @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="display: none">
                            <label for="longitude" class="col-md-4 col-form-label text-md-right">{{ __('Longitude') }}</label>
                            <div class="col-md-6">
                                <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="00.00000000" required autocomplete="longitude">
                                @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Attach Picture') }}</label>
                            <div class="col-md-6">
                                <input  id="picture" type="file" class="form-control custom-file-btn @error('picture') is-invalid @enderror" name="picture" value="{{ old('picture') }}" required autocomplete="picture">
                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row col-md-10 offset-md-1">
                         <span style="font-weight: 800">Comfrot Filters: </span>
                         <br><br>
                         <div id="checkboxes">
                             <div class="comfort-check">
                                 <input type="checkbox" name="wifi" value="1">
                                 ​<label for="wifi">WiFi</label>
                             </div>

                             <div class="comfort-check">
                                 <input type="checkbox" name="parking" value="2">
                                 ​<label for="parking">Parking</label>
                             </div>

                             <div class="comfort-check">
                                 <input type="checkbox" name="pool" value="3">
                                 ​<label for="pool">Pool</label>
                             </div>

                             <div class="comfort-check">
                                 <input type="checkbox" name="reception" value="4">
                                 ​<label for="reception">Reception</label>
                             </div>

                             <div class="comfort-check">
                                 <input type="checkbox" name="sauna" value="5">
                                 ​<label for="sauna">Sauna</label>
                             </div>

                             <div class="comfort-check">
                                 <input type="checkbox" name="seaview" value="6">
                                 ​<label for="seaview">Seaview</label>
                             </div>

                             <div class="comfort-check">
                                 <input type="checkbox" name="massage" value="7">
                                 ​<label for="massage">Massage</label>
                             </div>

                             <div class="comfort-check">
                                 <input type="checkbox" name="solarium" value="8">
                                 ​<label for="solarium">Solarium</label>
                             </div>

                             <div class="comfort-check">
                                 <input type="checkbox" name="sport" value="9">
                                 ​<label for="sport">Sport</label>
                             </div>

                             <div class="comfort-check">
                                 <input type="checkbox" name="golf" value="10">
                                 ​<label for="golf">Golf</label>
                             </div>

                         </div>
                        </div>
                        <div class="form-group row">
                            <label for="visibile" class="col-md-4 col-form-label text-md-right">{{ __('Visible on Search') }}</label>
                            <div class="col-md-6">
                              <select id="visible" name="visible" style="margin-top: 7px;">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Used ID') }}</label>
                            <div class="col-md-6" style="display: none">
                                <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="@auth {{ Auth::user() -> id }} @else 0 @endauth" required autocomplete="user_id">
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="createBtn" class="btn btn-primary">
                                    {{ __('Add Appartment') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FyaT6jXKAH42SKiBUpVZb0ip4OKxY2Y&libraries=places&v=3.exp"></script>
<script type="text/javascript">

  function editBtnListener() {
    var input = $('#createBtn');
    input.click(locationCutter);
  }

  function locationCutter() {
    var city = $('#city').val();
    var street = $('#street').val();
    var cutCity = city.split(', ')[0];
    var partStreet = street.split(', ');
    var nameStreet = partStreet[0];
    var possibleNum = partStreet[1];
    if(parseInt(partStreet[1])) {
      var defStreet = partStreet[0] + ', ' + partStreet[1];
    } else {
      var defStreet = partStreet[0];
    }
    city = $('#city').val(cutCity);
    street = $('#street').val(defStreet);
  }

  function initialize() {
      var optionsCity = {
          types: ['(cities)'],
          componentRestrictions: {
              country: "it"
          }
      };
      var inputCity = document.getElementById('city');
      var autocomplete = new google.maps.places.Autocomplete(inputCity, optionsCity);
      var optionsAddr = {
          types: ['address'],
          componentRestrictions: {
              country: "it"
          }
      };
      var inputStreet = document.getElementById('street');
      var autocomplete = new google.maps.places.Autocomplete(inputStreet, optionsAddr);
  }
  google.maps.event.addDomListener(window, 'load', initialize);
  
  $(document).ready(editBtnListener);
</script>

@endsection
