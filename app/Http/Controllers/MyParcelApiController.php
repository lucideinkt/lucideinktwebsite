<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MyParcelApiController extends Controller
{
    private string $baseUrl = 'https://api.myparcel.nl';

    private function authHeader(): string
    {
        return 'basic ' . base64_encode(config('services.myparcel.api_key'));
    }

    public function deliveryOptions(Request $request)
    {
        $request->validate([
            'cc'          => 'required|string|size:2',
            'postal_code' => 'required|string',
            'number'      => 'required|string',
        ]);

        $response = Http::withHeaders([
            'Accept'        => 'application/json;charset=utf-8;version=2.0',
            'Authorization' => $this->authHeader(),
        ])->get("{$this->baseUrl}/delivery_options", [
            'platform'    => 'myparcel',
            'carrier'     => 'postnl',
            'cc'          => strtoupper($request->cc),
            'postal_code' => strtoupper(str_replace(' ', '', $request->postal_code)),
            'number'      => $request->number,
        ]);

        return response()->json($response->json(), $response->status());
    }

    public function pickupLocations(Request $request)
    {
        $request->validate([
            'cc'          => 'required|string|size:2',
            'postal_code' => 'required|string',
            'number'      => 'required|string',
        ]);

        $response = Http::withHeaders([
            'Accept'        => 'application/json;charset=utf-8;version=2.0',
            'Authorization' => $this->authHeader(),
        ])->get("{$this->baseUrl}/pickup_locations", [
            'platform'    => 'myparcel',
            'carrier'     => 'postnl',
            'cc'          => strtoupper($request->cc),
            'postal_code' => strtoupper(str_replace(' ', '', $request->postal_code)),
            'number'      => $request->number,
        ]);

        return response()->json($response->json(), $response->status());
    }
}

