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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // BIGINT, PRIMARY KEY, AUTO_INCREMENT, NOT NULL
            $table->string('user_name')->unique(); // VARCHAR(255), NOT NULL, UNIQUE
            $table->string('user_password'); // VARCHAR(255), NOT NULL (備考: ハッシュ化するべき)
            $table->timestamp('created_at')->useCurrent(); // TIMESTAMP, NOT NULL, DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // TIMESTAMP, NOT NULL, DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};