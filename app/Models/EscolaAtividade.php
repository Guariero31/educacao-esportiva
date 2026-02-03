<?php

namespace App\Models;

use App\Enums\Periodo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscolaAtividade extends Model
{
    use HasFactory;
    protected $table = 'escola_atividades'; // Nome da tabela correspondente

    protected $fillable = [
        'escola_id',
        'atividade_id',
        'periodo',
        'dia_semana'

    ];



    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class,'atividade_id');
    }
}
