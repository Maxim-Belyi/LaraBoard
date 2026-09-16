<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Location;

class WeatherController extends Controller
{
    public function index(): JsonResponse
    {
        $locations = Location::where('is_active', true)
        ->with(['weatherRecords' => fn ($query) => $query->latest()->limit(1)])
        ->get();
        return response()->json($locations);
    }

    public function show(Location $location): JsonResponse
    {
       return response()->json(
        $location->load(['weatherRecords' => fn ($query) => $query->latest()->limit(10)])
       );
    }
}
