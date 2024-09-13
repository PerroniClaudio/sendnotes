<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <wireui:scripts />
    </head>
    <body class="font-sans antialiased">
        <main class="min-h-screen bg-slate-300">
            <div class="flex flex-col mx-auto max-w-7xl">
                @if (Route::has('login'))
                    <livewire:welcome.navigation />
                @endif

                <section class="flex flex-col items-center justify-center h-72">
                    <x-application-logo class="w-auto h-24 mx-auto mt-8" />
                    <x-button primary>
                        <a href="{{ route('login') }}">Get started</a>
                    </x-button>
                </section>
            </div>
        </main>
    </body>
</html>