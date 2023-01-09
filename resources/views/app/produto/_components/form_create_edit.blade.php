@if (isset($item->nome))
    <form method="POST" action="{{ route('produto.update', ['item' => $item->id ]) }}">
    @csrf
    @method('PUT')
@else
    <form method="POST" action="{{ route('produto.store') }}">
    @csrf
@endif

    <select name="fornecedor_id" class="borda-preta">
        <option value="0">-- Selecione o fornecedor --</option>
        
        @foreach ($fornecedores as $fornecedor)
            <option value="{{ $fornecedor->id }}" {{ ($item->fornecedor_id ?? old('fornecedor_id')) == $fornecedor->id ? 'selected' : '' }}>{{$fornecedor->nome}} - {{$fornecedor->uf}}</option>
        @endforeach
    </select>
    {{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : '' }}

    <input type="text" name="nome" value="{{ $item->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta" />
    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

    <input type="text" name="descricao" value="{{ $item->descricao ?? old('descricao') }}" placeholder="Descrição" class="borda-preta" />
    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

    <input type="text" name="peso" value="{{ $item->peso ?? old('peso') }}" placeholder="Peso" class="borda-preta" />
    {{ $errors->has('peso') ? $errors->first('peso') : '' }}

    <select name="unidade_id" class="borda-preta">
        <option value="0">-- Selecione a unidade de medida --</option>
        
        @foreach ($unidades as $unidade)
            <option value="{{ $unidade->id }}" {{ ($item->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>{{$unidade->unidade}} - {{$unidade->descricao}}</option>
        @endforeach
        
    </select>
    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}

    <button type="submit" class="borda-preta bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        @if (isset($item->nome))
            Atualizar
        @else
            Cadastrar
        @endif
    </button>
</form>
{{ $msg ?? ''}}