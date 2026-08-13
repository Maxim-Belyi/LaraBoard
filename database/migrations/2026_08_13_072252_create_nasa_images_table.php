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
        Schema::create('nasa_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('nasa_topic_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('nasa_id')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('image_url')->unique();
            $table->dateTime('date_created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasa_images');
    }
};
