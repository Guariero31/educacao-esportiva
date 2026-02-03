<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramacaoTable extends Migration
{
    public function up()
    {
        Schema::create('programacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turma_id');
            $table->string('dia_semana');
            $table->time('inicio');
            $table->time('fim');
            $table->string('local');
            $table->timestamps();

            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('programacao');
    }
}
