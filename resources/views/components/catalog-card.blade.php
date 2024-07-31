@props(['catalog'])

<x-card class="w-96 m-6">
    <x-slot name="image">
        <img
            src="{{$catalog->cover ? asset($catalog->cover) : asset('images/no-image.png')}}"
            alt="Catalog Logo"/>
    </x-slot>
    <x-slot name="title">
        <a href="/catalogs/{{$catalog->id}}">{{$catalog->name}}</a>
    </x-slot>
</x-card>



