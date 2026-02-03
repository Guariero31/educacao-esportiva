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
        Schema::create('users_escolas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('escola_id');
            $table->timestamps();

            // Definindo as chaves estrangeiras e índices
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('escola_id')->references('id')->on('escolas')->onDelete('cascade');
            $table->unique(['user_id', 'escola_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_escolas');
    }
};
