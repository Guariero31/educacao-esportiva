<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasTable extends Migration
{
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('capacidade')->default(0);
            $table->unsignedBigInteger('escola_atividade_id');
            $table->timestamps();
            //$table->foreign('escola_id')->references('id')->on('escolas')->onDelete('cascade');
            $table->foreign('escola_atividade_id')->references('id')->on('escola_atividades')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('turmas');
    }
}
