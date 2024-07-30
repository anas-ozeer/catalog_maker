<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __($item->name) }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        <div class="flex flex-col items-center">
            <div class="w-full mt-1">
                <img
                    class="w-full h-full object-cover rounded-lg shadow-md"
                    src="{{ $item->item_image ? asset('storage/'.$item->item_image) : asset('images/no-image.png') }}"
                    alt="Item Image"
                />
            </div>
        </div>
        <div class="flex flex-col space-y-4">
            <div class="font-bold text-2xl">
                Description
            </div>

            <div class="text-gray-700 h-full">
                {{ $item->description }}
            </div>

            @can('modify_item', $item)
                <button
                type="button"
                class="w-full bg-black text-white py-2 px-4 my-4 hover:shadow-md rounded-xl"
                x-data=""
                x-on:click="$dispatch('open-modal', 'edit-item-{{$item['id']}}')"
                >
                Edit Item
                </button>

                <button
                type="button"
                class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-xl"
                x-data=""
                x-on:click="$dispatch('open-modal', 'confirm-item-deletion-{{$item['id']}}')"
                >
                Delete Item
                </button>
            @endcan

        </div>
    </div>
</x-app-layout>



<!-- Edit Item Modal -->
<x-modal name="edit-item-{{$item['id']}}" :show="$errors->any()" focusable>
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
                <x-secondary-button x-on:click="$dispatch('close')" >
                    Cancel
                </x-secondary-button>
                <x-primary-button>
                    Edit
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>


<!-- Confirmation Modal -->
<x-modal name="confirm-item-deletion-{{$item['id']}}" :show="false" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Are you sure you want to delete this catalog?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            This action cannot be undone.
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                Cancel
            </x-secondary-button>

            <form action="/items/{{ $item->id }}" method="POST" class="ml-3">
                @csrf
                @method('DELETE')
                <x-danger-button type="submit">
                    Delete Item
                </x-danger-button>
            </form>
        </div>
    </div>
</x-modal>

