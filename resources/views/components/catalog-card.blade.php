@props(['catalog'])

<x-card class="w-72 m-6">
    <x-slot name="image">
        <img
            class="md:block"
            src="{{$catalog->logo ? asset('storage/'.$catalog->logo) : asset('images/no-image.png')}}"
            alt="Catalog Logo"/>
    </x-slot>
    <x-slot name="title">
        <a href="/catalogs/{{$catalog->id}}">{{$catalog->name}}</a>
    </x-slot>
</x-card>



