@if (isset($item_detalhe->comprimento))
    <form method="POST" action="{{ route('item-detalhe.update', ['item_detalhe' => $item_detalhe->id ]) }}">
    @csrf
    @method('PUT')
@else
    <form method="POST" action="{{ route('item-detalhe.store') }}">
    @csrf
@endif

    <input type="text" name="produto_id" value="{{ $item_detalhe->produto_id ?? old('produto_id') }}" placeholder="ID do Produto" class="borda-preta" />
    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

    <input type="text" name="comprimento" value="{{ $item_detalhe->comprimento ?? old('comprimento') }}" placeholder="Comprimento" class="borda-preta" />
    {{ $errors->has('comprimento') ? $errors->first('comprimento') : '' }}

    <input type="text" name="largura" value="{{ $item_detalhe->largura ?? old('largura') }}" placeholder="Largura" class="borda-preta" />
    {{ $errors->has('largura') ? $errors->first('largura') : '' }}

    <input type="text" name="altura" value="{{ $item_detalhe->altura ?? old('altura') }}" placeholder="Altura" class="borda-preta" />
    {{ $errors->has('altura') ? $errors->first('altura') : '' }}

    <select name="unidade_id" class="borda-preta">
        <option value="0">-- Selecione a unidade de medida --</option>
        
        @foreach ($unidades as $unidade)
            <option value="{{ $unidade->id }}" {{ ($item_detalhe->unidade_id ?? old('unidade_id')) == $unidade->id ? 'selected' : '' }}>{{$unidade->unidade}} - {{$unidade->descricao}}</option>
        @endforeach
        
    </select>
    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}

    <button type="submit" class="borda-preta bg-blue-500 hover:bg-blue-700 text-white font-bold mt-4 mb-4 py-2 px-4 rounded">
        @if (isset($item_detalhe->comprimento))
            Atualizar
        @else
            Cadastrar
        @endif
    </button>
</form>
