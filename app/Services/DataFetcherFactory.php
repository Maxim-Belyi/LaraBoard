<?php

namespace App\Services;

use App\Contracts\DataFetcherInterface;
use App\Models\GithubRepository;
use App\Models\Location;
use App\Models\NasaTopic;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class DataFetcherFactory
{
    public function make(Model $model): DataFetcherInterface
    {
        return match (get_class($model)) {
            Location::class => app(OpenWeatherService::class),
            GithubRepository::class => app(GithubService::class),
            NasaTopic::class => app(NasaService::class),
            default => throw new InvalidArgumentException(
                "Модель не найдена [" . get_class($model) . "]"
            ),
        };
    }
}
