<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark dark">
            <a class="navbar-brand" href="/">Ma Todo List</a>
            <a class="navbar-brand btn btn-primary" href="liste"><i class="bi bi-app"></i>Liste</a>

            <a class="navbar-brand btn btn-danger" href="compteur">Compteur</a>
        </nav>

        @yield('content')
        @vite(['resources/js/app.js'])

    </body>
</html>