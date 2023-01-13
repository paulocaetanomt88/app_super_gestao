
<form method="POST" action="{{ route('pedido-produto.store', ['pedido' => $pedido]) }}">
    @csrf
    <select name="produto_id" class="borda-preta">
        <option value="0">-- Selecione o produto --</option>
        
        @foreach ($produtos as $produto)
            <option value="{{ $produto->id }}" {{  old('produto_id') == $produto->id ? 'selected' : '' }}>{{$produto->nome}}</option>
        @endforeach
    </select>
    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

    <input type="number" name="quantidade" value="{{ old('quantidade') ? old('quantidade') : '' }}" placeholder="Quantidade" class="borda-preta" />
    {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}

    <button type="submit" class="borda-preta bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Adicionar
    </button>
</form>
