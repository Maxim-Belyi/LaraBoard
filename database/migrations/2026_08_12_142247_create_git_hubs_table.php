<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('git_hubs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('owner');
            $table->string('repo_name');
            $table->string('primary_language');
            $table->boolean('is_active')->default(true);

            $table->unique(['owner', 'repo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('git_hubs');
    }
};
