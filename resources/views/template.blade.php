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
            <a class="navbar-brand btn btn-primary" href="search"><i class="bi bi-search"></i> Rechercher</a>
            <a class="navbar-brand btn btn-primary" href="liste"><i class="bi bi-list-check"></i> Liste</a>
            <a class="navbar-brand btn btn-danger" href="planning"><i class="bi bi-calendar-check"></i> Planning</a>
            <a class="navbar-brand btn btn-danger" href="compteur"><i class="bi bi-sort-numeric-up"></i> Compteur</a>
            <a class="navbar-brand btn btn-danger" href="profile"><i class="bi bi-person"></i> Profile Utilisateur</a>
        </nav>

        @yield('content')
        @vite(['resources/js/app.js'])

    </body>
</html>