@extends('app.layouts.basico')

@section('titulo', 'Editar Detalhes do Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Produto - Editar Detalhes</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="#">Voltar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <h4>Produto</h4>
                <p class="mt-4">Nome: {{ $item_detalhe->item->nome }}</p>
                <p class="mt-4">Descrição: {{ $item_detalhe->item->descricao }}</p>
                @component('app.produto_detalhe._components.form_create_edit', ['item_detalhe' => $item_detalhe, 'unidades' => $unidades])
                @endcomponent
                <p class="mt-4">{{ $msg ?? ''}}</p>
            </div>
        </div>
    </div>
@endsection