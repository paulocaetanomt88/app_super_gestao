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

@isset($fornecedores)

    @forelse ($fornecedores as $fornecedor)
        Fornecedor: {{ $fornecedor['nome'] }} <br />
        Status: {{ $fornecedor['status'] }} -
        @if ($fornecedor['status'] == 'S')
                ativo
        @elseif ($fornecedor['status'] == 'N')
                inativo
        @endif
        <br />
        CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado não foi preenchido' }}
        <br />
        Telefone: ({{ $fornecedor['ddd'] ?? '' }}) {{ $fornecedor['telefone'] ?? ''}}
        <br />
        @switch($fornecedor['ddd'])
            @case('65')
                Cuiabá - MT
                @break
            @case('11')
                São Paulo - SP
                @break
            @case('21')
                Rio de Janeiro - RJ
                @break
            @default
        @endswitch
        <br />
        @if($loop->first)
            Primeira interação do loop <br />
        @elseif ($loop->last)
            Última interação do loop <br /><br />
            Total de registros: {{$loop->count}}
        @endif

        <br />
        @empty
            Não existem fornecedores cadastrados.
    @endforelse

@endisset

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

