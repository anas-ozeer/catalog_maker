<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/svg" href="/catalog.svg"/>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased min-h-screen flex items-center justify-center">

        @if (Route::has('login'))
            <main class="flex flex-row">
                <div>
                    <div class="text-5xl font-bold m-5">
                        This is Catalog Maker
                    </div>
                    <div class="flex flex-row items-center justify-center">
                        @auth
                        <div class="m-5">
                            <a
                                href="{{ url('/dashboard') }}"
                                class=" bg-black text-white px-4 py-2 rounded-xl text-xl hover:hover:shadow-2xl"
                            >
                                Dashboard
                            </a>
                        </div>

                        @else
                        <div class="m-5">
                            <a
                                href="{{ route('login') }}"
                                class=" bg-black text-white px-4 py-2 rounded-xl text-xl hover:hover:shadow-2xl"
                            >
                                Log in
                            </a>
                        </div>

                        @if (Route::has('register'))
                        <div class="m-5">
                        <a
                            href="{{ route('register') }}"
                            class=" bg-black text-white px-4 py-2 rounded-xl text-xl hover:shadow-2xl"
                        >
                            Register
                        </a>
                        </div>
                    </div>

                    @endif
                    @endauth
                </div>
            </main>
        @endif
    </body>
</html>
