<div>
    <div class="bg-white rounded-xl p-5 border">
        <div class="mt-4">
            <h2 class="text-lg font-semibold">Atividades</h2>
            <div class="grid grid-cols-{{count($aluno->turmas)}}">
                @foreach ($aluno->turmas as $turma)
                    <div class="mt-2">
                        <p class="text-md font-medium">{{ $turma->atividade->nome }}</p>
                        <p class="text-sm">
                            Escola: {{ $turma->escola->nome }}<br>
                            Turma: {{ $turma->nome }}<br>
                        </p>
                        <div class="text-sm">
                            Programação:
                            <ul>
                                @foreach ($turma->programacoes as $programacao)
                                    <li>
                                        {{ $programacao->dia_semana->getLabel() }}
                                        ({{ timeFormat($programacao->inicio)." - ".timeFormat($programacao->fim) }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
