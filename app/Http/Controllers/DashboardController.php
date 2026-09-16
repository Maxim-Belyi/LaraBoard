<?php

namespace App\Http\Controllers;

use App\Models\GithubRepository;
use App\Models\Location;
use App\Models\NasaTopic;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Get the latest Github repository data
        $github = GithubRepository::where('is_active', true)
            ->with(['githubRepoStatuses' => fn($query) => $query->latest()->limit(1)])
            ->first();

        // Get the latest NASA topic data
        $nasa = NasaTopic::where('is_active', true)
            ->with(['nasaImages' => fn($query) => $query->latest()->limit(1)])
            ->first();

        // Get the latest Weather location data
        $weather = Location::where('is_active', true)
            ->with(['weatherRecords' => fn($query) => $query->latest()->limit(1)])
            ->first();

        return view('dashboard', [
            'github' => $github,
            'nasa' => $nasa,
            'weather' => $weather,
        ]);
    }
}
