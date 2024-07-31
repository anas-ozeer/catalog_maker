@props(['catalog'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }} PDF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    @page {
        size: A4;
    }

    .page {
        page-break-after: always;
        width: 210mm;
        height: 297mm;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }


</style>
<body>
        {{-- The logo cover --}}
        <div class="page border-2 border-black">
            <img src="{{$catalog->cover ? asset($catalog->cover) : asset('images/no-image.png')}}" class="w-full h-full">
        </div>
        @php
            $items = $catalog->items;
            $count = 0;
        @endphp
        {{-- The items --}}
        @foreach ($items as $item)
            <div class="page border-2 border-black bg-gray-100">
                <header class="flex items-center justify-between p-5">
                    <img src="{{ $item->catalog->cover ? asset($item->catalog->cover) : asset('images/no-image.png') }}" alt="" class="w-auto h-14 rounded border-2">
                    <h1 class="flex-grow text-center text-xl">{{ $item->name }}</h1>
                </header>
                <div class="content p-5">
                    <div class="flex justify-center h-[50vh] rounded-xl shadow-md border-2 bg-white"><img src="{{$item->image ? asset($item->image) : asset('images/no-image.png') }}"  alt="{{ $item->name }}"></div>
                    @if (!empty($item->description))
                    <p class="my-5 text-justify"><strong>Description: </strong>{{ $item->description }}</p>
                    @endif
                    <p class="my-20 text-center text-2xl">Rs{{number_format($item->price, 2) }}</p>

                </div>
                <footer class="text-right p-5">
                    {{++$count}}
                </footer>
            </div>
        @endforeach
</body>
</html>



