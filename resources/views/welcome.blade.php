@extends('layouts.app')
@section('content')
<body>
  <div class="container-fluid search-form-welcome">
      <div class="row justify-content-center align-content-center">
          <div id="search-fixed" class="content">
              <form action="{{route('searched-appartment')}}" method="GET">
                  <input id="city" class="@error('search') is-invalid @enderror" type="text" style="width: 250px; height: 30px; padding: 10px;" name="search" value="" placeholder="Type City Name...">
                  <div class="line"></div>
                  <select id="radius" class="searchselect" name="radius">
                      <option value="20" disabled selected>Radius Distance (Km)</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                  </select>
                  <div class="line"></div>
                  <select id="minRoom" class="searchselect" name="min_room_number">
                      <option value="1" disabled selected>Rooms Number</option>
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
                  </select>
                  <div class="line"></div>
                  <select id="minBed" class="searchselect" name="min_bed_number">
                      <option value="1" disabled selected>Beds Number</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                  <button id="btnsearch" style="cursor: pointer; outline: none;" type="submit" name="button" disabled><i class="fa fa-search"></i></button>
                  @error('search')
                    <div class="invalid-feedback" style="margin-left: 5px; text-align: center; text-shadow: 1px 1px 1px white;" role="alert">
                      <strong>{{ $message }}</strong>
                    </div>
                  @enderror
              </form>
          </div>
      </div>
  </div>
  <section id="wrapper">
    <div class="container">
        <h4 style="font-weight: 800; margin-top: 30px; border-bottom: solid 1px #ccc; padding-bottom: 5px;">
            <i class="fa fa-star" style="color:  #FF385C"></i>
            Promoted Appartments:
        </h4>
        <div class="row text-left justify-content-between">
          @php
            $count = 0;
          @endphp
          @foreach ($randSuites as $randSuite)
            @foreach ($randSuite -> promotions as $promSuite)
              @php
                if ($count == 6) break;
              @endphp
            <div class="col-xs-6 col-md-5 col-lg-3 ml-1 mr-1">
              <div>
                <a href="{{ route('show-appartment', $randSuite -> id) }}">
                  <img class="card-suite-img" src="{{ asset('storage/'. $randSuite -> picture) }}" alt="suite_picture" onError="this.onerror=null;this.src='{{ asset('images/roomdef.png') }}';">
                </a>
              </div>
              <div class="card-suite-description">
                <h6 style="font-weight: bold;">{{ $randSuite -> title }}</h6>
                <span class="card_suite_description">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  {{ $randSuite -> city }}
                </span>
              </div>
            </div>
              @php
                $count++;
              @endphp
            @endforeach
          @endforeach
        </div>
    </div>

  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FyaT6jXKAH42SKiBUpVZb0ip4OKxY2Y&libraries=places&v=3.exp"></script>
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

<script>
  // window.onscroll = function() {myFunction()};
  //
  // var header = document.getElementById("search-fixed");
  // var sticky = header.offsetTop;
  //
  // function myFunction() {
  //   if (window.pageYOffset > sticky) {
  //     header.classList.add("sticky");
  //   } else {
  //     header.classList.remove("sticky");
  //   }
  // }

  // versione jQuery
  function windowScroll() {
    $(window).scroll(fixSearchBar);
  }

  function fixSearchBar() {
    var scrolltop = $(this).scrollTop();
    var searchBarDist = $('#search-fixed').position();

    if (scrolltop > searchBarDist.top) {
      $('#search-fixed').addClass('sticky');
    } else {
      $('#search-fixed').removeClass('sticky');
    }

  }



  $(document).ready(windowScroll);
</script>

@endsection
