@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Produto - Adicionar</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ redirect()->back() }}">Voltar</a></li>
                <li><a href="">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form method="POST" action="{{ route('produto.store') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $produto->id ?? '' }}">
                    <input type="text" name="nome" value="{{ old('nome') }}" placeholder="Nome" class="borda-preta" />
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                    <input type="text" name="descricao" value="{{ old('descricao') }}" placeholder="Descrição" class="borda-preta" />
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

                    <input type="text" name="peso" value="{{ old('peso') }}" placeholder="Peso" class="borda-preta" />
                    {{ $errors->has('peso') ? $errors->first('peso') : '' }}

                    <select name="unidade_id">
                        <option value="0">-- Selecione a unidade de medida --</option>
                        
                        @foreach ($unidades as $unidade)
                            <option value="{{ $unidade->id }}" {{ old('unidade_id') == $unidade->id ? 'selected' : '' }}>{{$unidade->unidade}} - {{$unidade->descricao}}</option>
                        @endforeach
                        
                    </select>
                    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}

                    <button type="submit" class="borda-preta bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cadastrar</button>
                </form>
                    {{ $msg ?? ''}}
            </div>
        </div>
    </div>
@endsection