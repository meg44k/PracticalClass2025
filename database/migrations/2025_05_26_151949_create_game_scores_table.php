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
        Schema::create('game_scores', function (Blueprint $table) {
            $table->id('game_score_id'); // BIGINT, PRIMARY KEY, AUTO_INCREMENT, NOT NULL
            
            $table->unsignedBigInteger('game_id'); // BIGINT, NOT NULL
            $table->foreign('game_id')->references('game_id')->on('games')->onDelete('cascade'); // FOREIGN KEY REFERENCES Games(game_id)
            
            $table->unsignedBigInteger('user_id'); // BIGINT, NOT NULL
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); // FOREIGN KEY REFERENCES Users(user_id)
            
            $table->integer('score'); // INT, NOT NULL
            $table->integer('rank_in_game'); // INT, NOT NULL
            $table->integer('type_count')->default(0); // INT, NOT NULL, DEFAULT 0
            $table->integer('missed_type_count')->default(0); // INT, NOT NULL, DEFAULT 0
            
            $table->unique(['game_id', 'user_id']); // UNIQUE (game_id, user_id)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_scores');
    }
};