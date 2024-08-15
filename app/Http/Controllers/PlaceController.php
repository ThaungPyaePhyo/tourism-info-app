<?php

namespace App\Http\Controllers;

use App\Services\PlaceService;
use GuzzleHttp\Exception\RequestException;

class PlaceController extends Controller
{
    public function __construct(protected placeService $placeService)
    {
    }

    public function getPlaces($city)
    {
        $client = new \GuzzleHttp\Client();
        $apiKey = config('app.foursquare_api_key');

        try {
            $data = $this->placeService->getData($client,$apiKey,$city);
            return response()->json($data['results']);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Unable to fetch places'], 500);
        }
    }
}
