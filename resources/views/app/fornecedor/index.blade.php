<h3>Fornecedores </h3>

{{-- Este é um comentário que é usado para documentar uma função, classe, etc e será  descartado pelo blade --}}
{{--
    @if (count($fornecedores)>0 && count($fornecedores)<10)
        <h4>Lista de fornecedores cadastrados:</h4>
        <ul>
            @foreach($fornecedores as $fornecedor)
            <li>{{ $fornecedor }} </li>
            @endforeach
        </ul>
    @elseif (count($fornecedores)>10)
        <h3>Existem vários fornecedores cadastrados!</h3>
    @else
        <h3>Não existem fornecedores cadastrados.</h3>
    @endif
--}}

@foreach ($fornecedores as $fornecedor)
    Fornecedor: {{ $fornecedor['nome'] }} <br />
    Status: {{ $fornecedor['status'] }} -
    @if ($fornecedor['status'] == 'S')
            ativo
    @elseif ($fornecedor['status'] == 'N')
            inativo
    @endif
    <br />
    @isset($fornecedor['cnpj'])
        CNPJ: {{ $fornecedor['cnpj'] }}
        @empty($fornecedor['cnpj'])
            - vazio
        @endempty
    @endisset
    <br /><br />
@endforeach

{{--
    Comando

    @unless (...)
        ...
    @endunless

    retorna se a condição for false

    Exemplo:
    @unless ($fornecedores[0]['status'] == 'S')
        inativo
    @endunless
--}}

