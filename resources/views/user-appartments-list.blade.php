@extends('layouts.app')
@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('My Appartments List') }}</div>
                    <div class="card-body">
                        <div id="user_appartments">
                            @foreach ($suites as $suite)
                            @if ($suite -> user_id == Auth::user() -> id)
                            <div class="card-row">
                                {{-- User Suites Images --}}
                                <div class="user-app-img col-md-4">
                                    <a href="{{ route('show-appartment', $suite -> id) }}">
                                        <img src="{{ asset('storage/'. $suite -> picture) }}" alt="room_picture" onError="this.onerror=null;this.src='{{ asset('images/roomdef.png') }}';">
                                    </a>
                                </div>
                                {{-- User Suites Description --}}
                                <div class="user-app-details col-xs-12 col-md-7 offset-md-1">
                                    <i class="fa fa-home" style="color: #ff385c"></i>
                                    <a class="user-app-link" href="{{ route('show-appartment', $suite -> id) }}">
                                        {{ $suite -> title }} placed in {{ $suite -> city }}
                                    </a>
                                    <br>
                                    Suite ID: <b> {{ $suite -> id }} </b>
                                    <br>
                                </div>
                                {{-- Edit Delete Buttons Container --}}
                                <div class="container-fluid  justify-content-between align-items-center col-xs-12" style="display: flex; width:100%" ;>
                                    <div class="user-app-btn-edit col-xs-12">
                                        <a class="btn btn-primary edit-btn" href="{{ route('edit-appartment', $suite -> id) }}">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                        <a class="btn btn-danger" href="{{ route('destroy-appartment', $suite -> id)}}">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </a>
                                    </div>
                                    <div class="col-xs-12 visible">
                                        Visible on Search:
                                        @if($suite -> visible == 1) <span style="color: green;"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        @else <span style="color: red;"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                        @endif<br>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="back-homepage-btn" style="width: 150px">
                            <a href="{{ route('welcome') }}">
                                <i class="fa fa-reply"></i>
                                Back to Main page
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

@endsection
