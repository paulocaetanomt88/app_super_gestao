@extends('app.layouts.basico')

@section('titulo', 'Editar Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Produto - Editar</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.index') }}">Voltar</a></li>
                <li><a href="{{ route('produto.index') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component('app.produto._components.form_create_edit', ['item' => $item, 'unidades' => $unidades, 'fornecedores' => $fornecedores])
                @endcomponent
                <p class="mt-4">{{ $msg ?? ''}}</p>
            </div>
        </div>
    </div>
    
@endsection