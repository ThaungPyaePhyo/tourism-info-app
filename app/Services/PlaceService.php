<?php

namespace App\Services;

class PlaceService
{
    public function getData($client,$apiKey,$city)
    {
        $response = $client->request('GET', 'https://api.foursquare.com/v3/places/search', [
            'headers' => [
                'Authorization' => $apiKey,
                'accept' => 'application/json',
            ],
            'query' => [
                'near' => $city,
                'limit' => 5,
            ],
        ]);
        return json_decode($response->getBody(), true);
    }
}
