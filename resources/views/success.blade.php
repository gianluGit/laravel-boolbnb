@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    {{ __('Success!') }}
                    <br><br>

                    <div class="back-homepage-btn justify-content-start" style="width: 150px">
                      <a class="" href="{{ route('welcome') }}">
                        <i class="fa fa-reply"></i>
                        Back to Main page
                      </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
