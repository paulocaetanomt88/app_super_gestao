@extends('app.layouts.basico')

@section('titulo', 'Produto')
    
@section('estilos')
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/sweetalert2.min.css') }}" rel="stylesheet">
@endsection

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Produto - Listar</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('item-detalhe.create') }}">Novo</a></li>
                <li><a href="{{ route('item-detalhe.index') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <table class="table-auto self-auto" align="center">
                <thead>
                  <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Nome</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Comprimento</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Largura</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Altura</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Visualizar</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Editar</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Excluir</th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                    @foreach ($itens_detalhes as $item_detalhes)
                        <tr>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $item_detalhes->item->nome ?? '' }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $item_detalhes->comprimento ?? '' }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $item_detalhes->largura ?? '' }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $item_detalhes->altura ?? '' }}</td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                <a class="btn btn-xs btn-info btn-flat  btn-sm" href="{{ route('item-detalhe.show', [ 'item_detalhe' => $item_detalhes->id ]) }}">
                                    Ver
                                </a>
                            </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                <a class="btn btn-xs btn-secondary btn-flat  btn-sm" href="{{ route('item-detalhe.edit', ['item_detalhe' => $item_detalhes->id]) }}">
                                    Editar
                                </a> 
                            </td>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 ">
                                <form method="POST" id="delete" name="delete" action="{{ route('item-detalhe.destroy', ['item_detalhe' => $item_detalhes->id]) }}">
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
              <div class="row flex justify-center">
                <div class="col-md-12">
                    {{ $itens_detalhes->appends($request)->links('pagination::tailwind') }}
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
                    Exibindo {{ $itens_detalhes->count() }} produtos de {{ $itens_detalhes->total() }} (de {{ $itens_detalhes->firstItem() }} a {{ $itens_detalhes->lastItem() }} )
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