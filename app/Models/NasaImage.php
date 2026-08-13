<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NasaImage extends Model
{
    /** @use HasFactory<\Database\Factories\NasaImageFactory> */
    use HasFactory;

    protected $fillable = [
        'nasa_topic_id',
        'nasa_id',
        'title',
        'description',
        'image_url',
        'date_created',
    ];

    protected function casts(): array
    {
        return [
            'date_created' => 'datetime',
        ];
    }

    public function nasaTopic(): BelongsTo
    {
        return $this->belongsTo(NasaTopic::class);
    }
}
