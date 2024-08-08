@props(['item'])

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
    </head>
    <body>
            <div class="h-screen flex justify-between w-full items-center">
                <div class="w-1/5 h-70 mx-4">
                    <div class="mb-4 text-lg font-semibold">
                        {{$item->name}}
                    </div>
                    <img
                        class="rounded-lg shadow-md my-4"
                        src="{{ $item->image ? asset($item->image) : asset('images/no-image.png') }}"
                        alt="Item Image"
                    />
                </div>
                <form action="/items/{{$item->id}}/bulk_update_image" class="flex-grow flex" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="file" name="item_image" id="item_image" accept="image/*" class="flex-grow" >
                    <button type="submit" class="rounded-xl bg-black text-white px-4 py-2 mx-4">
                        Submit
                    </button>
                </form>
            </div>
    </body>
</html>


