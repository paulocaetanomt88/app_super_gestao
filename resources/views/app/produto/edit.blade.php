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
            </div>
        </div>
        @if (isset($msg) && $msg!='')
            <div style="width: 30%; text-align: center;  margin-left: auto; margin-right: auto; " class="w-auto inline-block  items-center mt-4 text-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                {{ $msg }}
            </div>
        @endif
    </div>
    
@endsection