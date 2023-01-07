@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Fornecedor - Listar</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
                <li><a href="{{ route('app.fornecedor.listar') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <table class="table-auto self-auto" align="center">
                <thead>
                  <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Nome</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Site</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">UF</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">E-mail</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Editar</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Excluir</th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                    @foreach ($fornecedores as $fornecedor)
                        <tr>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $fornecedor->nome }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ $fornecedor->site }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $fornecedor->uf }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $fornecedor->email }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400"><a href="{{ route('app.fornecedor.editar', ['id' => $fornecedor->id]) }}">[e]</a></td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400"><a href="{{ route('app.fornecedor.excluir', ['id' => $fornecedor->id]) }}">[x]</a></td>
                        </tr>
                        @if ($fornecedor->produtos->count() > 0)
                            <tr>
                                <td colspan="6" class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                    <table class="table-auto self-auto" align="center">
                                        <thead>
                                            <tr>
                                                <td colspan="6" class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">Produtos de {{ $fornecedor->nome }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">ID</th>
                                                <th colspan="3" class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Nome do Produto</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-slate-800">
                                            @foreach ($fornecedor->produtos as $produto)
                                                <tr>
                                                    <td colspan="3" class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $produto->id }}</td>
                                                    <td colspan="3" class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $produto->nome }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
              <br>
              <div class="row flex justify-center">
                <div class="col-md-12">
                    {{ $fornecedores->appends($request)->links('pagination::tailwind') }}
                    <br />
                    {{-- 
                    Exibindo {{ $fornecedores->count() }} registros por página.
                    <br>
                    Total de registros: {{ $fornecedores->total() }}
                    <br>
                    Número do primeiro registro desta página na relação do resultado da busca: {{ $fornecedores->firstItem() }}
                    <br>
                    Número do último registro desta página na relação do resultado da busca: {{ $fornecedores->lastItem() }}
                    --}}
                    Exibindo {{ $fornecedores->count() }} fornecedores de {{ $fornecedores->total() }} (de {{ $fornecedores->firstItem() }} a {{ $fornecedores->lastItem() }} )
                </div>
            </div>
        </div>  
    </div>

    
    
@endsection