<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Main Pages
Route::get('/', 'WelcomeController@index') -> name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

// CRUD Suites
Route::get('/create/appartment', 'SuiteController@create') -> name('create-appartment');
Route::post('/store/appartment', 'SuiteController@store') -> name('store-appartment');
Route::get('/show/appartment/{id}', 'GuestController@show') -> name('show-appartment');
Route::get('/user/appartments/list', 'SuiteController@userAppList') -> name('user-appartments-list');
Route::get('/coordinates', 'ApiHandlerController@getNearSuites') -> name('get-coordinates'); // Testing Route
Route::get('/edit/appartment/{id}', 'SuiteController@edit') -> name('edit-appartment');
Route::post('/update/appartment/{id}', 'SuiteController@update') -> name('update-appartment');
Route::get('/destroy/appartment/{id}', 'SuiteController@destroy') -> name('destroy-appartment');

// Message
Route::get('/user/messages/list', 'MessageController@userMsgList') -> name('user-messages-list');
Route::post('/store/message', 'GuestController@store') -> name('store-message');
Route::get('/destroy/message/{id}', 'MessageController@destroy') -> name('destroy-message');

// API for Suite Search
Route::get('/api/suites/all', 'GuestController@getNearSuites') -> name('searched-appartment');

Route::get('auto-complete-city', 'AutoCompleteController@index')->name('auto-complete-city'); // Testing Route

// Success Alert
Route::get('/success', 'SuccessController@index') -> name('success');

// Unauthorized Alert
Route::get('/unauthorized', 'UnauthorizedController@index') -> name('unauthorized');

// Testing Routes for Braintree
Route::get('/payments/{id}', 'PromotionController@index') -> name('payment-index');
Route::post('/payments/checkout/{id}', 'PromotionController@checkout') -> name('payment-checkout');

// Suite Stats Route
Route::get('/stats/appartment/{id}', 'VisitController@showStats') -> name('show-stats');
