@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Fornecedor</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
                <li><a href="{{ route('app.fornecedor.listar') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form method="POST" action="{{ route('app.fornecedor.listar') }}">
                    @csrf
                    <input type="text" name="nome" placeholder="Nome" class="borda-preta" />
                    <input type="text" name="site" placeholder="Site" class="borda-preta" />
                    <input type="text" name="uf" placeholder="UF" class="borda-preta" />
                    <input type="text" name="email" placeholder="E-mail" class="borda-preta" />
                    <button type="submit" class="borda-preta bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Pesquisar</button>
                </form>
            </div>
        </div>
    </div>
@endsection