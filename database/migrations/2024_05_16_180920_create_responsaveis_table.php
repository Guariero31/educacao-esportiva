<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('responsaveis', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('rg')->nullable();
            $table->date('rg_data_emissao')->nullable();
            $table->string('rg_orgao_emissor')->nullable();
            $table->string('rg_uf')->nullable();
            $table->string('cpf')->nullable();
            $table->string('parentesco')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->boolean('responsavel_legal')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('responsaveis', function (Blueprint $table) {
            $table->dropColumn([
                'rg',
                'rg_data_emissao',
                'rg_orgao_emissor',
                'rg_uf',
                'cpf',
                'parentesco',
                'celular',
                'email',
                'responsavel_legal'
            ]);
        });
    }
};
