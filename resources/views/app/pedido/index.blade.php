@extends('app.layouts.basico')

@section('titulo', 'Pedidos')
    
@section('estilos')
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/sweetalert2.min.css') }}" rel="stylesheet">
@endsection

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Lista de Pedidos</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.create') }}">Novo</a></li>
                <li><a href="{{ route('pedido.index') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <table class="table-auto self-auto" align="center">
                <thead>
                  <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">ID do Pedido</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Cliente</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"></th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Visualizar</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Editar</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Excluir</th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                    {{-- Verificando se a coleção $pedidos esta vazia --}}
                    @if ($pedidos->isNotEmpty())
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $pedido->id }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $pedido->cliente->nome }}</td>

                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                    <a class="btn btn-xs btn-info btn-flat  btn-sm" href="{{ route('pedido-produto.create', [ 'pedido' => $pedido->id ]) }}">Adicionar Produtos</a>
                                </td>

                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                    <a class="btn btn-xs btn-info btn-flat  btn-sm" href="{{ route('pedido.show', [ 'pedido' => $pedido->id ]) }}">Ver</a>
                                </td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                    <a class="btn btn-xs btn-secondary btn-flat  btn-sm" href="{{ route('pedido.edit', ['pedido' => $pedido->id]) }}">Editar</a> 
                                </td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                    <form method="POST" id="delete" name="delete" action="{{ route('pedido.destroy', ['pedido' => $pedido->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input id="funcao" type="hidden" value="DELETE">
                                        <button
                                            type="submit"
                                            id="delete"
                                            name="delete"
                                            value="delete"
                                            class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip"
                                            onclick="confirm">
                                            Excluir
                                        </button>
                                        {{-- <a href="">[x]</a> --}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Não existem pedidos.</td>
                        </tr>
                    @endif
                </tbody>
              </table>
              <br>

              <div class="row flex justify-center">
                <div class="col-md-12">
                    {{ $pedidos->appends($request)->links('pagination::tailwind') }}
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
                    Exibindo {{ $pedidos->count() }} pedidos de {{ $pedidos->total() }} (de {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }} )
                </div>
            </div>
            
        </div>  
    </div>

    
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/sweetalert.min.js') }}"></script>
    
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event){
            var form =  $(this).closest("form");
            var name = $(this).data("name");

            event.preventDefault();

            swal({
                title: "Deseja realmente deletar esse registro?",
                text: "Se deletar, não será possível recuperar este registro depois.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancelar","Sim!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
    
@endsection