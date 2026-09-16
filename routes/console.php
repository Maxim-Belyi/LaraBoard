<?php

use App\Jobs\FetchModelDataJob;
use App\Models\GithubRepository;
use App\Models\Location;
use App\Models\NasaTopic;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    Location::where('is_active', true)
        ->lazy()
        ->each(fn(Location $location) => FetchModelDataJob::dispatch($location));

    GithubRepository::where('is_active', true)
        ->lazy()
        ->each(fn(GithubRepository $githubRepository) => FetchModelDataJob::dispatch($githubRepository));

    NasaTopic::where('is_active', true)
        ->lazy()
        ->each(fn(NasaTopic $nasa) => FetchModelDataJob::dispatch($nasa));
})->everyMinute();
