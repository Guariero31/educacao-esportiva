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
        Schema::create('aluno_responsavel', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('aluno_id')->unsigned();
            $table->bigInteger('responsavel_id')->unsigned();
            $table->timestamps();

            $table
                ->foreign('responsavel_id')
                ->references('id')
                ->on('responsaveis')
                ->onDelete('cascade');

            $table
                ->foreign('aluno_id')
                ->references('id')
                ->on('alunos')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aluno_responsavel');
    }
};
