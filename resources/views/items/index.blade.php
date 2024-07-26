<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __($catalog->name.' Items') }}
        </h2>
    </x-slot>
    @php
        $items = $catalog->items;
    @endphp
    <div class="flex flex-wrap justify-evenly mb-20">
        @foreach ($items as $item)
            <x-item-card :item="$item">
            </x-item-card>
        @endforeach
    </div>
    <div class="fixed bottom-0 left-0 w-full font-bold h-24">
        <button
        type="button"
        class="absolute rounded-xl top-1/3 right-10 bg-black text-white py-2 px-5 hover:shadow-md"
        x-data=""
        x-on:click="$dispatch('open-modal', 'create-item')"
        >
        Create Item
        </button>
    </div>
</x-app-layout>

<!-- Create Item Modal -->
<x-modal name="create-item" :show="false" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Create an Item
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Fill in the details for the item
        </p>
        <form action="/items" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="catalog_id" value="{{ $catalog->id }}">
            <div class="mb-6">
                <x-input-label for="name" >Name</x-input-label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{ old('name') }}" required/>
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
                <x-input-label for="item_image" >
                    Item Image
                </x-input-label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="item_image"
                    accept="image/*"
                />
                @error('item_image')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <x-input-label for="price" >Price</x-input-label>
                <input type="number" step="0.01" min="0" placeholder="0.00" class="border border-gray-200 rounded p-2 w-full" name="price" value="{{ old('price') }}" required />
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>
                <x-primary-button class="mx-2">
                    Create
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>


