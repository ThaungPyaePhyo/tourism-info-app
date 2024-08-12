<?php

use App\Http\Controllers\PlaceController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather/{city}', [WeatherController::class, 'getWeather']);
Route::get('/places/{city}', [PlaceController::class, 'getPlaces']);
