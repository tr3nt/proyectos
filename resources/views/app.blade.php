<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Projects</title>

        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body>
        <div class="container mx-auto p-4">
            @yield('content')
        </div>
        @livewireScripts
    </body>
</html>
