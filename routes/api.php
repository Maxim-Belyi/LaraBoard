<?php

use App\Http\Controllers\Api\GithubController;
use App\Http\Controllers\Api\NasaController;
use App\Http\Controllers\Api\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('weather', WeatherController::class)->only('index', 'show');
Route::apiResource('github', GithubController::class)->only('index', 'show');
Route::apiResource('nasa', NasaController::class)->only('index', 'show');
