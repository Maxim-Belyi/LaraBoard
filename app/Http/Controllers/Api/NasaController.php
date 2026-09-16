<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\NasaTopic;

class NasaController extends Controller
{

    public function index(): JsonResponse
    {
        $topic = NasaTopic::where('is_active', true)
            ->with(['nasaImages' => fn($query) => $query->latest()->limit(5)])
            ->get();
        return response()->json($topic);
    }

    public function show(NasaTopic $nasaTopic): JsonResponse
    {
        return response()->json(
            $nasaTopic->load('nasaImages')
        );
    }
}
