@extends('app.layouts.basico')

@section('titulo', 'Visualizar dados do Cliente')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <h3>Visualizar dados do Cliente</h3>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('cliente.index') }}">Voltar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <table class="table-auto self-auto" align="center">
                    <thead>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Nome</th>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $cliente->nome; }}</td>
                        </tr>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Telefone</th>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $cliente->telefone; }}</td>
                        </tr>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Email</th>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $cliente->email; }}</td>
                        </tr>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Endereço</th>
                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $cliente->endereco; }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection