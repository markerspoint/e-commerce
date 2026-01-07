<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ShopLink')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9f9f7;
        }
    </style>
</head>

<body class="antialiased text-shop-black bg-shop-bg">

    @include('partials.header')

    <main class="@yield('main-class', 'min-h-screen')">
        @yield('content')
    </main>

    @unless (View::hasSection('hide-footer'))
        @include('partials.footer')
    @endunless

    @stack('scripts')
</body>

</html>
