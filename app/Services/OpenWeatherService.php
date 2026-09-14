<?php

namespace App\Services;

use App\Contracts\DataFetcherInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class OpenWeatherService implements DataFetcherInterface
{
    public function getWeatherByCoords(float $latitude, float $longitude): array
    {
        $response = Http::baseUrl(config('services.openweather.base_url'))
            ->timeout(5)
            ->retry(3, 500)
            ->get('/weather', [
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => config('services.openweather.key'),
                'units' => 'metric',
            ])->throw();

        return [
            'temp' => $response->json('main.temp'),
            'feels_like' => $response->json('main.feels_like'),
            'pressure' => $response->json('main.pressure'),
            'humidity' => $response->json('main.humidity'),
            'wind_speed' => $response->json('wind.speed'),
            'description' => $response->json('weather.0.description'),
            'icon' => $response->json('weather.0.icon'),
            'dt' => $response->json('dt')
        ];
    }
    public function fetch(Model $model): array
    {
        return $this->getWeatherByCoords($model->latitude, $model->longitude);
    }
}
