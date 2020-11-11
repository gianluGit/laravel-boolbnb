@extends('layouts.app')
@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('My Message List') }}</div>
                    <div class="card-body">
                        <label for="sorting">Sort by:</label>
                        <select class="" name="sorting">
                            <option value="toprecent" default>Date (Most Recent First)</option>
                        </select><hr>
                        <ul>
                            @foreach ($results as $result)
                            <div class="message-box">
                                <ul class="message-row">
                                    <li> <b>Message date:</b> {{ $result -> created_at }} <br>
                                    </li>
                                    <li>
                                        <b>Related to your Suite ID:</b> <u> {{ $result -> suite_id }} </u> <br>
                                    </li>
                                    <li>
                                        <b>Customer email:</b> {{ $result -> email_sender }} <br>
                                    </li>
                                    <li class="message">
                                        <b class="message-cnt-user"><i class="fa fa-envelope-o" aria-hidden="true"></i> Message Content <i class="fa fa-arrow-down"></i><i class="fa fa-arrow-up" style="display: none"></i></b>
                                        <br> <div class="messageTest"> <em>{{ $result -> content }}</em></div>
                                    </li>
                                    <span>
                                        <a class="btn btn-danger" style="margin-top: 5px;" href="{{ route('destroy-message', $result -> id) }}">
                                            <b><i class="fa fa-trash-o"></i> Delete</b>
                                        </a>
                                    </span>
                                </ul>
                            </div>
                            @endforeach
                        </ul>
                        <div class="back-homepage-btn" style="width: 150px">
                            <a href="{{ route('welcome') }}">
                                <i class="fa fa-reply"></i>
                                Back to Main Page
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
