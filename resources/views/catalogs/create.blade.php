<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <x-card class="p-5 w-1/2">
            <header class="text-center">
                <h2 class="text-2xl font-bold mb-1">
                    Create a new Catalog
                </h2>
                <p class="mb-4">Please provide us with more information about the Catalog</p>
            </header>

            <form method="POST" action="/catalogs" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <x-input-label for="catalog_name" >Name</x-input-label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="catalog_name" value="{{ old('catalog_name') }}" />
                    @error('catalog_name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <x-input-label for="catalog_description" >Description</x-input-label>
                    <textarea class="border border-gray-200 rounded p-2 w-full min-h-10 max-h-56" name="catalog_description" >{{ old('catalog_description') }}</textarea>
                    @error('catalog_description')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <x-input-label for="cover" >
                        Cover
                    </x-input-label>
                    <input
                        type="file"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="cover"
                        value="{{old('cover')}}"
                        accept="image/*"
                    />
                    @error('cover')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <button class="rounded-xl py-2 px-4 bg-black text-white" type="submit">
                        Create Catalog
                    </button>

                    <a href="/catalogs/index" class="text-black ml-4">Back</a>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
