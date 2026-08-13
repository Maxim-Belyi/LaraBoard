<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GithubRepository extends Model
{
    /** @use HasFactory<\Database\Factories\GithubRepositoryFactory> */
    use HasFactory;

    protected $fillable = [
        'owner',
        'repo',
        'primary_language',
        'is_active',
    ];

    public function githubRepoStatuses(): HasMany {
        return $this->hasMany(GithubRepoStatus::class);
    }

}
