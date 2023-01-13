@extends('app.layouts.basico')

@section('titulo', 'Adicionar Produtos ao Pedido')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>
                Pedido - Adicionar Produtos
            </h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                
                <h4>Detalhes do Pedido</h4>
                <table class="table-auto self-auto" align="center">
                    <thead>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">ID do Pedido</th>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $pedido->id; }}</td>
                        </tr>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Cliente</th>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $pedido->cliente->nome; }}</td>
                        </tr>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Endereço de entrega:</th>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $pedido->cliente->endereco; }}</td>
                        </tr>
                    </thead>
                </table>
                <h4>Itens do pedido:</h4>
                
                <table class="table-auto self-auto" align="center">
                    <thead>
                        <tr>
                            <th class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">ID do produto</th>
                            <th class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">Nome do produto</th>
                            <th class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">Quantidade</th>
                            <th class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">Data de inclusão do item no pedido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->produtos as $produto)
                            <tr>
                                <td class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ $produto->id; }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $produto->nome; }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $produto->pivot->quantidade; }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $produto->pivot->created_at->format('d/m/Y H:i:s'); }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @component('app.pedido_produto._components.form_create', ['pedido' => $pedido, 'produtos' => $produtos])
                @endcomponent
            </div>
        </div>
        @if (isset($msg) && $msg!='')
            <div style="width: 30%; text-align: center;  margin-left: auto; margin-right: auto; " class="w-auto inline-block  items-center mt-4 text-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                {{ $msg }}
            </div>
        @endif
    </div>

@endsection