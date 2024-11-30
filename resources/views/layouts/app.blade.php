<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Proyecto I.S') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


</head>
    <body>
        <div id='app'>
            <header id='navbar' style="margin: 20px;">
            @include('partials.nav_bar')
            </header>
            <main class="py-4" style="margin: 20px;">
            @include('partials.messages')
            @include('partials.validation_errors')
            @yield('content')
            </main>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('scripts')
    </body>
</html>