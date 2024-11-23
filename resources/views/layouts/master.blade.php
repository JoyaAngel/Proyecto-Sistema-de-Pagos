<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Administrativo</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <header>
        @include('partials.nav-bar')
    </header>
    <div class="container mt-4">
        @include('partials.validation-errors')
        @include('partials.messages')
        @yield('content')
    </div>
</body>
</html>