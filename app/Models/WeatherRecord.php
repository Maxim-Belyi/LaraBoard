<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherRecord extends Model
{
    /** @use HasFactory<\Database\Factories\WeatherRecordFactory> */
    use HasFactory;
     protected $fillable = [
        'location_id',
        'temp',
        'feels_like',
        'pressure',
        'humidity',
        'wind_speed',
        'description',
        'icon',
        'recorded_at',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
