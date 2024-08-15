<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getData($city,$apiKey)
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);
        return $response;
    }
}
