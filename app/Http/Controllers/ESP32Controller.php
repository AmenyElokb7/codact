<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ESP32Controller extends Controller
{
    public function sendPictureURL(Request $request)
    {
        // Get the picture URL from the request
        $pictureURL = $request->input('picture_url');

        // Perform any necessary validation or processing of the URL

        // Send the picture URL to the ESP32
        // Example using Guzzle HTTP client:
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://192.168.1.19/receive-picture-url', [
            'form_params' => [
                'picture_url' => $pictureURL,
            ],
        ]);

        return response()->json(['message' => 'Picture URL sent to ESP32']);
    }

}
