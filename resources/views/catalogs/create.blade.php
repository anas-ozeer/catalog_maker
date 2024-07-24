<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new Catalog') }}
        </h2>
    </x-slot> --}}
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold mb-1">
                Create a new Catalog
            </h2>
            <p class="mb-4">Please provide us with more information about the Catalog</p>
        </header>

        <form method="POST" action="/catalogs" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <x-input-label for="name" >Name</x-input-label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{ old('name') }}" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <x-input-label for="description" >Description</x-input-label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <x-input-label for="logo" >
                    Logo
                </x-input-label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                    accept="image/*"
                />
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="rounded py-2 px-4 bg-black text-white" type="submit">
                    Create Catalog
                </button>

                <a href="{{route('catalogs.index')}}" class="text-black ml-4">Back</a>
            </div>
        </form>
    </x-card>
</x-app-layout>
