<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\GithubRepository;

class GithubController extends Controller
{
    public function index(): JsonResponse
    {
        $repositories = GithubRepository::where('is_active', true)
            ->with(['metrics' => fn($query) => $query->latest()->limit(1)])
            ->get();
    }


    public function show(GithubRepository $githubRepository): JsonResponse
    {
        return response()->json(
            $githubRepository->load(['metrics' => fn($query) => $query->latest()->limit(10)])
        );
    }
}
