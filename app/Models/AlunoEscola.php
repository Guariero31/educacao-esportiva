<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoEscola extends Model
{
    
    protected $table = 'aluno_escolas';

    // Especifica os campos que podem ser preenchidos em massa
    protected $fillable = [
        'aluno_id',
        'escola_id',
    ];

    // Define a relação com o modelo Aluno
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    // Define a relação com o modelo Escola
    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }
}
