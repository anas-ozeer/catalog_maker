<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if ($catalogs->isEmpty())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("No catalogs found!") }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-wrap justify-evenly mb-20">
            @foreach ($catalogs as $catalog)
                <x-catalog-card :catalog="$catalog">
                </x-catalog-card>
            @endforeach
        </div>

    @endif
    <div class="fixed bottom-0 left-0 w-full font-bold h-24">
        <a
            href="{{route('catalogs.create')}}"
            class="absolute rounded-xl top-1/3 right-10 bg-black text-white py-2 px-5 hover:shadow-md"
            >Create Catalog</a
        >
    </div>
</x-app-layout>
