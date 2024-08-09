<?php

namespace App\Http\Controllers\Frontend;
use App\Services\DHLService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    public function trackOrder($trackingNumber)
{
    $tracking = Tracking::where('tracking_number', $trackingNumber)->first();

    if ($tracking) {
        $response = Http::get("https://api.deliverypartner.com/track", [
            'tracking_number' => $tracking->tracking_number,
            'api_key' => 'your-api-key',
        ]);

        if ($response->successful()) {
            $tracking->status = $response['status'];
            $tracking->save();
            return $tracking;
        }
    }

    return null;
}

public function trackOrder($trackingNumber)
{
    $tracking = $this->trackOrder($trackingNumber);
    return view('Frontend.tracking', compact('tracking'));
}

}
