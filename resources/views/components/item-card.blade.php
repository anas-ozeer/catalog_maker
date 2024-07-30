@props(['item'])
<x-card class="m-6 w-72">

    <x-slot name="image">
        <img class="w-full h-60 object-cover" src="{{$item->item_image ? asset('storage/'.$item->item_image) : asset('images/no-image.png')}}" alt="An image is here">
    </x-slot>

    <x-slot name="title">
        <a href="/items/{{$item->id}}">{{ $item->name }}</a>
    </x-slot>

    <x-slot name="price">
        {{ $item->price }}
    </x-slot>
</x-card>















