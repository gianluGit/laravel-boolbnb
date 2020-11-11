@extends('layouts.app')
@section('content')
​
@auth
  @if($suite -> user_id == Auth::user() -> id)
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">

          <canvas id="dailyChart">
          </canvas>
          ​
          <canvas id="monthlyChart">
          </canvas>

        </div>
      </div>

    </div>​
    <div style="display: flex; justify-content: center;">
      <div class="back-homepage-btn" style="width: 115px;">
        <a href="{{ route('show-appartment', $suite -> id) }}">
          <i class="fa fa-reply"></i>
          Back to Suite
        </a>
      </div>
    </div>
  @else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">

                        {{ __('Unauthorized!') }}
                        <br><br>

                        <a href="{{ route('welcome') }}">Back to Main page</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
  @endif

@endauth

​
<script>
var ctx = document.getElementById('monthlyChart').getContext('2d');
var chart = new Chart(ctx, {
	// Tipologia di Grafico desiderato
	type: 'bar',
	// I dati per le coordinate del grafico
	data: {
			labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
			datasets: [{
					label: 'Monthly report',
					backgroundColor: '#ff385c',
					borderColor: '#dc3251',
					data: [@foreach ($monthsData as $month)
						{{$month}}
					@endforeach]
			}]
	},
	// Opzioni di configurazione
	options: {}
});
</script>
​
<script>
var ctx = document.getElementById('dailyChart').getContext('2d');
var chart = new Chart(ctx, {
	// Tipologia di Grafico desiderato
	type: 'bar',
	// I dati per le coordinate del grafico
	data: {
			labels: [ @foreach ($dayarray as $day)
				{{$day}}
			@endforeach ],
			datasets: [{
					label: 'Daily report',
					backgroundColor: '#ff385c',
					borderColor: '#dc3251',
					data: [@foreach ($dailyData as $day)
						{{$day}}
					@endforeach]
			}]
	},
	// Opzioni di configurazione
	options: {}
});
</script>
​
@endsection
