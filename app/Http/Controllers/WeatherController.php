<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function __construct(protected WeatherService $weatherService)
    {
    }
    public function getWeather($city)
    {
        $apiKey = config('app.openweather_api_key');
        try {
            $data = $this->weatherService->getData($city, $apiKey);
            return response()->json($data->json());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch Weather'], 500);
        }

    }
}
