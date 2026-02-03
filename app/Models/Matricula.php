<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\InscricaoStatus;

class Matricula extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => InscricaoStatus::class,
    ];
    protected $table = 'matriculas'; 

    protected $fillable = [
        'aluno_id',
        'escola_id',
        'status',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }
}
