<?php

use App\Models\GitHub;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('github_repo_statuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(GitHub::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedInteger('stars_count');
            $table->unsignedInteger('forks_count');
            $table->unsignedInteger('open_issues_count');
            $table->timestamp('recorded_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('github_repo_statuses');
    }
};
