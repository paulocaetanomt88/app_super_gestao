@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Fornecedor - Editar</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form method="POST" action="{{ route('app.fornecedor.atualizar') }}">
                    @csrf
                    <input type="text" name="nome" value="{{ $fornecedor['nome'] }}" placeholder="Nome" class="borda-preta" />
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                    <input type="text" name="site" value="{{ $fornecedor['site'] }}" placeholder="Site" class="borda-preta" />
                    {{ $errors->has('site') ? $errors->first('site') : '' }}

                    <input type="text" name="uf" value="{{ $fornecedor['uf'] }}" placeholder="UF" class="borda-preta" />
                    {{ $errors->has('uf') ? $errors->first('uf') : '' }}

                    <input type="text" name="email" value="{{ $fornecedor['email'] }}" placeholder="E-mail" class="borda-preta" />
                    {{ $errors->has('email') ? $errors->first('email') : '' }}

                    <input  type="hidden" name="id" value="{{ $fornecedor['id'] }}" />

                    <button type="submit" class="borda-preta">Atualizar</button>
                </form>
                @if (isset($msg))
                    {{$msg}}
                @endif
            </div>
        </div>
    </div>
@endsection