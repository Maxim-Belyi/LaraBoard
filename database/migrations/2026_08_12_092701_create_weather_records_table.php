<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('location_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->decimal('temp', 5, 2);
            $table->decimal('feels_like', 5, 2);
            $table->unsignedInteger('pressure');
            $table->unsignedInteger('humidity');
            $table->decimal('wind_speed', 5, 2);
            $table->string('description');
            $table->string('icon');
            $table->timestamp('recorded_at');

            $table->index(['location_id', 'recorded_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_records');
    }
};
