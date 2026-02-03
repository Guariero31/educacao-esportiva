<?php

namespace App\Models;

use App\Enums\DiaSemana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programacao extends Model
{
    use HasFactory;

    protected $table = 'programacao';

    protected $fillable = ['turma_id', 'dia_semana', 'inicio', 'fim', 'local'];

    protected $casts = [
        'dia_semana'=>DiaSemana::class,
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }
}
