<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Projects</title>

        <!-- Alpine -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- -->

        <!-- Tailwind -->
        @vite('resources/css/app.css')
        <!-- -->

        <!-- Livewire CSS -->
        @livewireStyles
    </head>
    <body>

        <!-- Laravel Blade -->
        <div x-data class="container mx-auto p-4">
            @yield('content')
        </div>
        <!-- -->

        <!-- Livewire JS -->
        @livewireScripts
        <!-- -->
    </body>
</html>
