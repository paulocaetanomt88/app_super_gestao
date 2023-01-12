@if (isset($pedido->nome))
    <form method="POST" action="{{ route('pedido.update', ['pedido' => $pedido->id ]) }}">
    @csrf
    @method('PUT')
@else
    <form method="POST" action="{{ route('pedido.store') }}">
    @csrf
@endif

    <select name="cliente_id" class="borda-preta">
        <option value="0">-- Selecione o cliente --</option>
        
        @foreach ($clientes as $cliente)
            <option value="{{ $cliente->id }}" {{ ($item->cliente_id ?? old('cliente_id')) == $cliente->id ? 'selected' : '' }}>{{$cliente->nome}} - {{$cliente->email}}</option>
        @endforeach
    </select>
    {{ $errors->has('cliente_id') ? $errors->first('cliente_id') : '' }}

    

    <button type="submit" class="borda-preta bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        @if (isset($pedido->nome))
            Atualizar
        @else
            Cadastrar
        @endif
    </button>
</form>
