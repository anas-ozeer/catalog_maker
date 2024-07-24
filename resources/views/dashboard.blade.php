<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("This is your Dashboard!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="fixed bottom-0 left-0 w-full font-bold h-24">
        <a
            href="{{route('catalogs.create')}}"
            class="absolute rounded top-1/3 right-10 bg-black text-white py-2 px-5 hover:shadow-md"
            >Create Catalog</a
        >
    </div>
</x-app-layout>
