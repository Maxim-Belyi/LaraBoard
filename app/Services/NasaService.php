<?php

namespace App\Services;

use App\Contracts\DataFetcherInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class NasaService implements DataFetcherInterface
{
    public function getNasaImages(string $query, int $limit = 10): array
    {
        $response = Http::baseUrl(config('services.nasa.base_url'))
            ->timeout(10)
            ->retry(3, 1000)
            ->get('/search', [
                'q' => $query,
                'media_type' => 'image'
            ])
            ->throw();

        $items = $response->json('collection.items', []);

        return collect($items)
            ->take($limit)
            ->map(function (array $item) {
                $data = $item['data'][0] ?? [];
                $link = $item['links'][0]['href'] ?? null;

                return [
                    'nasa_id' => $data['nasa_id'] ?? null,
                    'title' => $data['title'] ?? '',
                    'description' => $data['description'] ?? '',
                    'date_created' => $data['date_created'] ?? null,
                    'image_url' => $link
                ];
            })->toArray();
    }

    public function fetch(Model $model): array
    {
        return $this->getNasaImages($model->query, $model->limit);
    }
}
