<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Get Location using OpenCage Geocoder
     */
    private function getLocationFromOpenCage($latitude, $longitude)
    {
        $apiKey = '6e73d01739b343748b08fe7433780b71'; // Replace with your OpenCage API key
        $url = "https://api.opencagedata.com/geocode/v1/json?q={$latitude}+{$longitude}&key={$apiKey}";

        try {
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data['results'][0]['formatted'])) {
                return $data['results'][0]['formatted'];
            }

            return 'Unknown';
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }
    public function fetchLocation(Request $request)
    {
        // Get latitude and longitude from the request
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        if (!$latitude || !$longitude) {
            return response()->json(['error' => 'Coordinates are required.'], 400);
        }

        // Example: Fetch location using OpenCage (you can swap with other methods)
        $location = $this->getLocationFromOpenCage($latitude, $longitude);

        // Alternative: Uncomment to use Nominatim
        // $location = $this->getLocationFromNominatim($latitude, $longitude);

        // Alternative: Uncomment to use PositionStack
        // $location = $this->getLocationFromPositionStack($latitude, $longitude);

        return response()->json(['location' => $location]);
    }
}

// Example Route
// Add this route in your web.php or api.php file
// Route::post('/fetch-location', [LocationController::class, 'fetchLocation']);
