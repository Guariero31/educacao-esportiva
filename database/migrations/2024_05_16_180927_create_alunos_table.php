<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero_matricula')->nullable();
            $table->string('nome');
            $table->string('cpf', 14)->nullable();
            $table->string('escola_codigo')->nullable();
            $table->string('escola_nome')->nullable();
            $table->string('cep')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('complemento')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('sexo')->nullable();
            $table->date('nascimento')->nullable();
            $table->string('rg', 9)->nullable();
            $table->string('rg_data_expedicao')->nullable();
            $table->string('rg_orgao_expedicao')->nullable();
            $table->string('certidao_nascimento_numero')->nullable();
            $table->string('certidao_nascimento_livro')->nullable();
            $table->string('certidao_nascimento_folha')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('status_aluno_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('pne')->nullable();
            $table->unsignedBigInteger('cor_id')->nullable();
            $table->string('numero_nis')->nullable();
            $table->boolean('diabetico')->nullable();
            $table->boolean('deficiente')->nullable();
            $table->unsignedBigInteger('deficiencia_id')->nullable();
            $table->string('sus')->nullable();
            $table->string('nome_social')->nullable();
            $table->string('email_google')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('tipo_sanguineo')->nullable();
            $table->string('codigo_inep')->nullable();
            $table->string('status');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
