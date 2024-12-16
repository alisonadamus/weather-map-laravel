<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/weather', function (Request $request) {
    $city = $request->query('city');
    return view('weather', compact('city'));
});

Route::get('/api/weather', [WeatherController::class, 'getWeather'])->name('weather.get');
Route::get('/api/weather/weekly', [WeatherController::class, 'getWeeklyWeather'])->name('weather.weekly.get');
