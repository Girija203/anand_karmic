<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DHLService
{
    protected $apiKey;
    protected $username;
    protected $password;
    protected $endpoint;

    public function __construct()
    {
        $this->apiKey = env('DHL_API_KEY');
        $this->username = env('DHL_API_USERNAME');
        $this->password = env('DHL_API_PASSWORD');
        $this->endpoint = env('DHL_API_ENDPOINT');
    }

    public function getShipmentStatus($trackingNumber)
    {
        $response = Http::withHeaders([
            'Authorization' => 'username ' . $this->apiKey,
        ])->get($this->endpoint . 'track', [
            'tracking_number' => $trackingNumber,
        ]);

        if ($response->failed()) {
            throw new \Exception('DHL API request failed');
        }

        return $response->json();
    }    // Add more methods for other DHL API endpoints as needed
}
