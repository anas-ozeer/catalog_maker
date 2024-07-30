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
        margin: 1cm;
    }

    body {
        margin: 0;
        padding: 0;
    }

    .page {
        page-break-after: always;
        width: 210mm;
        height: 297mm;
        margin: auto;
        box-sizing: border-box;
        box-shadow: 0 0 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    header {
        border-bottom: 1px solid #000000;
    }

    footer {
        border-top: 1px solid #000000;
    }

    .content {
        flex-grow: 1;
        margin: 1cm 0;
    }

</style>
<body>
    {{-- The logo cover --}}
    <div class="page">
        <img src="{{$catalog->logo ? asset('storage/'.$catalog->logo) : asset('images/no-image.png')}}" class="w-full h-full">
    </div>
    @php
        $items = $catalog->items;
        $count = 0;
    @endphp
    @foreach ($items as $item)
        <div class="page">
            <header class="flex items-center justify-between p-5 ">
                <img src="{{ $item->catalog->logo ? asset('storage/'.$item->catalog->logo) : asset('images/no-image.png') }}" alt="" class="w-auto h-14 rounded border-2">
                <h1 class="flex-grow text-center text-xl">{{ $item->name }}</h1>
            </header>
            <div class="content p-10">
                <div class="item text-left">
                    <div class="flex justify-center h-[70vh]"><img src="{{$item->item_image ? asset('storage/'.$item->item_image) : asset('images/no-image.png')}}" alt="{{ $item->name }}"></div>
                    @if (!empty($item->description))
                    <p class="my-5"><strong>Description: </strong>{{ $item->description }}</p>
                    @endif
                    <p class="my-5"><strong>Price:</strong> ${{ number_format($item->price, 2) }}</p>
                </div>
            </div>
            <footer class="text-right p-5">
                This is the page #
            </footer>
        </div>
    @endforeach
</body>
</html>



