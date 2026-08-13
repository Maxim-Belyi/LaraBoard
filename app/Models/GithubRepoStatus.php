<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GithubRepoStatus extends Model
{
    /** @use HasFactory<\Database\Factories\GithubRepoStatusFactory> */
    use HasFactory;

    protected $fillable = [
        'github_repository_id',
        'stars_count',
        'forks_count',
        'open_issues_count',
        'recorded_at',
    ];

      protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function githubRepository(): BelongsTo {
        return $this->belongsTo(GithubRepository::class);
    }
}
