@props(['item'])
<x-card class="w-96 mt-6 p-2">

    <x-slot name="image">
        <img class="w-full h-60 object-cover" src="{{$item->item_image ? asset('storage/'.$item->item_image) : asset('images/no-image.png')}}" alt="An image is here">
    </x-slot>

    <x-slot name="price">
        <h2 class="font-bold text-xl mb-2 text-gray-800">{{ $item['name'] }}</h2>
        <p class="text-gray-600 text-base">{{ $item['price'] }}</p>
    </x-slot>

    <x-slot name="buttons">

        <a href="/items/{{$item['id']}}" class="inline-flex items-center text-blue-500 hover:text-blue-700 transition-colors duration-300">
            Show
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>

        <button
        type="button"
        class="text-gray-500 hover:text-gray-700 transition-colors duration-300"
        x-data=""
        x-on:click="$dispatch('open-modal', 'edit-item-{{$item['id']}}')"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L6 11.172V14h2.828l8.586-8.586a2 2 0 000-2.828zM4 16a1 1 0 001 1h10a1 1 0 100-2H5a1 1 0 00-1 1z"/>
            </svg>
        </button>

    </x-slot>
</x-card>

<!-- Edit Item Modal -->
<x-modal name="edit-item-{{$item['id']}}" :show="false" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Edit an Item
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Fill in the details for the item
        </p>
        <form action="/items/{{$item['id']}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-6">
                <x-input-label for="name" >Name</x-input-label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{$item['name']}}" required/>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <x-input-label for="description" >Description</x-input-label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10">{{$item['description']}}</textarea>
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
                    value="{{$item['item_image']}}"
                    accept="image/*"
                />
                @error('item_image')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <x-input-label for="price" >Price</x-input-label>
                <input type="number" step="0.01" min="0" placeholder="0.00" class="border border-gray-200 rounded p-2 w-full" name="price" value="{{$item['price']}}" required />
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>
                <x-primary-button class="mx-2">
                    Edit
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
















