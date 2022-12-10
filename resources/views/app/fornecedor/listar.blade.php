@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Fornecedor - Listar</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
                <li><a href="{{ route('app.fornecedor.listar') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <div style="width: 20%; margin-left: auto; margin-right: auto; float: left;">
                    <b>Nome</b>
                </div>
                <div style="width: 20%; margin-left: auto; margin-right: auto; float: left;">
                    <b>Site</b>
                </div>
                <div style="width: 20%; margin-left: auto; margin-right: auto; float: left;">
                    <b>UF</b>
                </div>
                <div style="width: 20%; margin-left: auto; margin-right: auto; float: left;">
                    <b>E-mail</b>
                </div>
                <div style="width: 10%; margin-left: auto; margin-right: auto; float: left;">
                    <b>Atualizar</b>
                </div>
                <div style="width: 10%; margin-left: auto; margin-right: auto; float: left;">
                    <b>Excluir</b>
                </div>
                @foreach ($fornecedores as $fornecedor)
                    <div style="clear: left;">
                        <div style="width: 20%; margin-left: auto; margin-right: auto; float: left;">
                            {{ $fornecedor['nome']; }}
                        </div>
                        <div style="width: 20%; margin-left: auto; margin-right: auto; float: left;">
                            {{ $fornecedor['site']; }}
                        </div>
                        <div style="width: 20%; margin-left: auto; margin-right: auto; float: left;">
                            {{ $fornecedor['uf']; }}
                        </div>
                        <div style="width: 20%; margin-left: auto; margin-right: auto; float: left;">
                            {{ $fornecedor['email']; }}
                        </div>
                        <div style="width: 10%; margin-left: auto; margin-right: auto; float: left;">
                            <a href="{{ route('app.fornecedor.editar', ['id' => $fornecedor['id']]) }}">[e]</a>
                        </div>
                        <div style="width: 10%; margin-left: auto; margin-right: auto; float: left;">
                            <a href="{{ route('app.fornecedor.excluir', ['id' => $fornecedor['id']]) }}">[x]</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection