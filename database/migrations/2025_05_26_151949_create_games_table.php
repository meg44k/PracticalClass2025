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
        Schema::create('games', function (Blueprint $table) {
            $table->id('game_id'); // BIGINT, PRIMARY KEY, AUTO_INCREMENT, NOT NULL
            $table->timestamp('played_at')->useCurrent(); // TIMESTAMP, NOT NULL, DEFAULT CURRENT_TIMESTAMP
            $table->integer('actual_participant_count'); // INT, NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};