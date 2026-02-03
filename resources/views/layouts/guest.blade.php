<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Chronos') }}</title>
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
        <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
        <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-100 antialiased bg-chronos-gradient">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-6 flex items-center justify-center">
                <a href="/" class="p-2 rounded-full bg-white/10 border border-white/10 shadow-md">
                    <x-application-logo class="w-20 h-20" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-6 glass-card-light shadow-xl overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
