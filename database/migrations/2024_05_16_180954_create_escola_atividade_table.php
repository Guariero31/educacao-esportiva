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
        Schema::create('escola_atividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escola_id');
            $table->unsignedBigInteger('atividade_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('escola_id')->references('id')->on('escolas');
            $table->foreign('atividade_id')->references('id')->on('atividades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escola_atividades');
    }
};
