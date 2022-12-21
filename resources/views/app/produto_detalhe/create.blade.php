@extends('app.layouts.basico')

@section('titulo', 'Adicionar Detalhes do Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>
                Produto - Adicionar detalhes
            </h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="#">Voltar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component('app.produto_detalhe._components.form_create_edit', ['unidades' => $unidades])
                @endcomponent
                <p class="mt-4">{{ $msg ?? ''}}</p>
            </div>
        </div>
    </div>

@endsection