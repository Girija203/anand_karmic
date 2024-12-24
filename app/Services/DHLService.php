<?php

namespace App\Services;

use GuzzleHttp\Client;

class DHLService
{
    protected $client;  

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.dhl.com/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('DHL_API_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function trackOrder($trackingNumber)
    {
        $response = $this->client->get('track/shipments', [
            'query' => ['trackingnumber' => $trackingNumber],
        ]);

        return json_decode($response->getBody(), true);
    }

}
