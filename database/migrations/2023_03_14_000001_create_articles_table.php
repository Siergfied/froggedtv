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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('cover', 255)->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('hook')->nullable();
            $table->text('content');
            $table->boolean('submitted')->nullable();
            $table->boolean('accepted')->nullable();
            $table->boolean('published')->nullable();
            $table->date('publish_date')->nullable();
            $table->boolean('highlight')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
