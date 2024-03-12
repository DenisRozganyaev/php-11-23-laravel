<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

    @auth
        <script>
            window.userID = {{ auth()->id() }}
        </script>
    @endauth

    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @include('navs.main')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/iziToast.js') }}"></script>
    @include('vendor.lara-izitoast.toast')
    @stack('footer-js')
</body>
</html>
