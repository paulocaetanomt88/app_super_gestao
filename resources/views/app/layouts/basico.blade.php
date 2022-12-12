<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>@yield('titulo')</title>
        <meta charset="utf-8">
        @vite('resources/css/app.css')

        
    </head>

    <body>
        @include('app.layouts._partials.topo')
        @yield('conteudo')
    </body>
</html>
