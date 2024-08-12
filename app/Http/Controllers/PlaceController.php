<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlaceController extends Controller
{
    public function getPlaces($city)
    {
        $apiKey = env('FOURSQUARE_API_KEY');
        $response = Http::get("https://api.foursquare.com/v2/venues/search", [
            'near' => $city,
            'client_id' => $apiKey,
            'v' => '20230101',
            'limit' => 5
        ]);

        return response()->json($response->json()['response']['venues']);
    }
}
