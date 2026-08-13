<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NasaTopic extends Model
{
    /** @use HasFactory<\Database\Factories\NasaTopicFactory> */
    use HasFactory;

    protected $fillable = [
        'query_text',
        'is_active'
    ];

    public function nasaImages():HasMany {
        return $this->hasMany(NasaImage::class);
    }
}
