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
        Schema::create('toolmix_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams');
            $table->integer('mmr_min')->nullable();
            $table->integer('mmr_max')->nullable();
            $table->boolean('hard_support')->default(false);
            $table->boolean('soft_support')->default(false);
            $table->boolean('off_lane')->default(false);
            $table->boolean('mid_lane')->default(false);
            $table->boolean('safe_lane')->default(false);
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toolmix_teams');
    }
};
