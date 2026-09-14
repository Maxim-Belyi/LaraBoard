<?php

namespace App\Services;

use App\Contracts\DataFetcherInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class GithubService implements DataFetcherInterface
{
    public function getRepoStats(string $owner, string $repo): array
    {
        $response = Http::baseUrl(config('services.github.base_url'))
            ->withHeaders(['User-Agent' => 'PulseBoard-App'])
            ->timeout(5)
            ->retry(3, 200)
            ->get("/repos/{$owner}/{$repo}")->throw();

        return [
            'stars_count' => $response->json('stargazers_count'),
            'forks_count' => $response->json('forks_count'),
            'open_issues_count' => $response->json('open_issues_count'),
            'primary_language' => $response->json('language'),
            'recorded_at' => now()
        ];
    }

    public function fetch(Model $model): array
    {
        return $this->getRepoStats($model->owner, $model->repo);
    }
}
