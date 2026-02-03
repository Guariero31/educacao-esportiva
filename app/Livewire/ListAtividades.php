<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Aluno;

class ListAtividades extends Component
{
    public $aluno;

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.list-atividades');
    }
}
