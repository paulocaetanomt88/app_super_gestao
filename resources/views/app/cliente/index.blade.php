@extends('app.layouts.basico')

@section('titulo', 'Clientes')
    
@section('estilos')
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/sweetalert2.min.css') }}" rel="stylesheet">
@endsection

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Clientes - Index</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('cliente.create') }}">Novo</a></li>
                <li><a href="{{ route('cliente.index') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <table class="table-auto self-auto" align="center">
                <thead>
                  <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Nome</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Telefone</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">E-mail</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Endereço</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Visualizar</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Editar</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Excluir</th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $cliente->nome }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $cliente->telefone }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $cliente->email }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $cliente->endereco }}</td>

                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                <a class="btn btn-xs btn-info btn-flat  btn-sm" href="{{ route('cliente.show', [ 'cliente' => $cliente->id ]) }}">Ver</a>
                            </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                <a class="btn btn-xs btn-secondary btn-flat  btn-sm" href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}">Editar</a> 
                            </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                <form method="POST" id="delete" name="delete" action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}">
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
                </tbody>
              </table>
              <br>
              {{-- Verificando se as coleções $clientes e $pedidos estão vazias --}}
              @if ($clientes->isNotEmpty())
                  Existem clientes e
              @else
                    Não existem clientes e
              @endif

              @if ($pedidos->isNotEmpty())
                  existem Pedidos.
              @else
                    não existem Pedidos.
              @endif
              
              <div class="row flex justify-center">
                <div class="col-md-12">
                    {{ $clientes->appends($request)->links('pagination::tailwind') }}
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
                    Exibindo {{ $clientes->count() }} clientes de {{ $clientes->total() }} (de {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }} )
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