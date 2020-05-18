<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:livewire="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf">
    <title>Waddup</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>

    @yield('content')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

    @livewireScripts
    <script>
        document.addEventListener('livewire:load', () => {
            setInterval(function(){ window.livewire.emit('alive'); }, 1800000);
        });
    </script>
</body>
</html>
