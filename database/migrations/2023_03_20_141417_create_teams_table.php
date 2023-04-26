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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('tag', 255);
            $table->string('logo', 255)->nullable();
            $table->integer('ingame_id')->nullable();
            $table->string('password');
            $table->foreignId('captain_id')->nullable()->constrained('users');
            $table->foreignId('vice_captain_id')->nullable()->constrained('users');
            $table->foreignId('coach_id')->nullable()->constrained('users');
            $table->boolean('roster_locked')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('team_id')->nullable()->constrained('teams');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
