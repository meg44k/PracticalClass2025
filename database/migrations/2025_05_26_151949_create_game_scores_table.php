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
            $table->id('game_id'); // BIGINT, PRIMARY KEY, AUTO_INCREMENT, NOT NULL
            $table->string('id');

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade'); // FOREIGN KEY REFERENCES Users(user_id)
            
            $table->integer('score'); // INT, NOT NULL
            $table->integer('type_count')->default(0); // INT, NOT NULL, DEFAULT 0
            $table->integer('missed_type_count')->default(0); // INT, NOT NULL, DEFAULT 0
            $table->timestamp('played_at')->useCurrent(); // TIMESTAMP, NOT NULL, DEFAULT CURRENT_TIMESTAMP
            
            $table->unique(['game_id', 'id']); // UNIQUE (game_id, user_id)
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