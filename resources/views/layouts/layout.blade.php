<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Projects</title>

        <!-- Tailwind -->
        @vite('resources/css/app.css')
        <!-- Livewire styles -->
        @livewireStyles
        <!-- Alpinejs -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- -->
    </head>
    <body class="h-screen text-center">
        <header>
            <nav class="flex justify-between items-center mx-auto w-[90%]">
                <div class="text-2xl leading-[4rem]">
                    Projects
                </div>
                <div class="leading-[4rem]">
                    <ul class="flex items-center gap-[4vw]">
                        <li><a class="hover:text-red-900" href="{{ route('home') }}">Home</a></li>
                        <li><a class="hover:text-red-900" href="{{ route('show') }}">Projects</a></li>
                    @auth
                        <li><a class="hover:text-red-900" href="{{ route('create') }}">New Project</a></li>
                    @endauth
                    </ul>
                </div>
                <div>
                    <ul class="flex items-center gap-[2vw]">
                    @guest
                        <li><a class="hover:text-red-900" href="{{ route('login') }}">Login</a></li>
                        <li><a class="hover:text-red-900" href="{{ route('register') }}">Register</a></li>
                    @endguest
                    @auth
                        @livewire('auth.logout')
                    @endauth
                    </ul>
                </div>
            </nav>
        </header>

        <main>
            <div class="@if (request()->url() !== 'http://proyectos.test/projects') flex h-screen @endif bg-gray-200 w-full justify-center items-center">
                @yield('content')
            </div>
        </main>

        <!-- Livewire scripts -->
        @livewireScripts
        <!-- -->

        @stack('js')
    </body>
</html>
