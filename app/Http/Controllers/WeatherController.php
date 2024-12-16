<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $city = $request->query('city');

        if (!$city) {
            return response()->json(['error' => 'City is required'], 400);
        }

        $apiKey = env('OPENWEATHER_API_KEY');
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'City not found'], 404);
        }

        return $response->json();
    }

    public function getWeeklyWeather(Request $request)
    {
        $city = $request->query('city');

        if (!$city) {
            return response()->json(['error' => 'City is required'], 400);
        }

        $apiKey = env('OPENWEATHER_API_KEY');
        $url = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&units=metric&cnt=8&appid={$apiKey}"; // Get the next 7 days

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'City not found'], 404);
        }

        return $response->json();
    }

}
