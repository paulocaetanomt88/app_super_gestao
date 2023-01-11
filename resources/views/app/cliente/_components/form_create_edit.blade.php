@if (isset($cliente->nome))
    <form method="POST" action="{{ route('cliente.update', ['cliente' => $cliente->id ]) }}">
    @csrf
    @method('PUT')
@else
    <form method="POST" action="{{ route('cliente.store') }}">
    @csrf
@endif


    <input type="text" name="nome" value="{{ $cliente->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta" />
    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

    <input type="text" name="telefone" value="{{ $cliente->telefone ?? old('telefone') }}" placeholder="(xx) xxxxx-xxxx" class="borda-preta" />
    {{ $errors->has('telefone') ? $errors->first('telefone') : '' }}

    <input type="email" name="email" value="{{ $cliente->email ?? old('email') }}" placeholder="E-mail" class="borda-preta" />
    {{ $errors->has('email') ? $errors->first('email') : '' }}

    <input type="endereco" name="endereco" value="{{ $cliente->endereco ?? old('endereco') }}" placeholder="Endereço" class="borda-preta" />
    {{ $errors->has('endereco') ? $errors->first('endereco') : '' }}

    <button type="submit" class="borda-preta bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        @if (isset($cliente->nome))
            Atualizar
        @else
            Cadastrar
        @endif
    </button>
</form>
