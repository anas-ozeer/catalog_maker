@php
    $items = $catalog->items;
    $items_count = 0;
@endphp
<x-app-layout>
    <div class="flex flex-wrap justify-evenly mb-20">
        @foreach ($items as $item)
            <x-item-card :item="$item">
                @php
                    $items_count++
                @endphp
            </x-item-card>
        @endforeach
    </div>
    @can('modify_catalog', $catalog)
        <div class="fixed bottom-0 w-full font-bold flex flex-wrap justify-end bg-white rounded-t-xl">
            <button
            type="button"
            class="bg-black text-white rounded-xl hover:shadow-md w-48 m-4 py-2 px-4"
            x-data=""
            x-on:click="$dispatch('open-modal', 'create-item')"
            >
            Create Item
            </button>

            <button
            type="button"
            class="bg-black text-white rounded-xl hover:shadow-md w-48 m-4 py-2 px-4"
            x-data=""
            x-on:click="$dispatch('open-modal', 'import_items')"
            >
            Import Items
            </button>

            <button
            type="button"
            class="bg-black text-white rounded-xl hover:shadow-md w-48 m-4 py-2 px-4"
            x-data=""
            x-on:click="$dispatch('open-modal', 'bulk_edit_image')"
            >
            Import Images
            </button>

            <button
            type="button"
            class="bg-black text-white rounded-xl hover:shadow-md w-48 m-4 py-2 px-4"
            onclick="generate_pdf({{$catalog->id}})"
            >
            Generate PDF
            </button>

            <button
            type="button"
            class=" bg-red-500 text-white rounded-xl hover:shadow-md w-48 m-4 py-2 px-4"
            x-data=""
            x-on:click="$dispatch('open-modal', 'delete_all')"
            >
            Delete all Items
            </button>
        </div>
    @endcan
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __("$catalog->name Items ($items_count)") }}
        </h2>
    </x-slot>
</x-app-layout>

<!-- Create Item Modal -->
<x-modal name="create-item" :show="$errors->has('item_name') || $errors->has('item_description') || $errors->has('item_image') || $errors->has('item_price')" focusable>
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
                <x-input-label for="item_name" >Name</x-input-label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="item_name" value="{{ old('item_name') }}" required/>
                @error('item_name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <x-input-label for="item_description" >Description</x-input-label>
                <textarea class="border border-gray-200 rounded p-2 w-full min-h-10 max-h-56" name="description">{{ old('item_description') }}</textarea>
                @error('item_description')
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
                <x-input-label for="item_price" >Price</x-input-label>
                <input type="number" step="0.01" min="0" placeholder="0.00" class="border border-gray-200 rounded p-2 w-full" name="item_price" value="{{ old('price') }}" required />
                @error('item_price')
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
{{-- Import Items Modal --}}
<x-modal name="import_items" :show="$errors->has('import_items')" focusable>
    <div class="p-6">
        <form action="/catalogs/{{$catalog->id}}/import_items" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input-label for="import_items">Import Items File</x-input-label>
            <p class="text-gray-700 text-xs mt-1">Please enter a file in the correct format (name, description, price)</p>
            <input name="import_items" class="w-full" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
            @error('import_items')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>
                <x-primary-button class="mx-2">
                    Import
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
<x-modal name="delete_all" :show="false" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Are you sure you want to delete this catalog?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            This action cannot be undone.
        </p>

        <div class="mt-6 flex justify-end">
            <button
           type="button"
            class=" mx-4 px-4 py-2 bg-white border border-gray-300 rounded-xl text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
            x-on:click="$dispatch('close')"
            >
                Cancel
            </button>
            <button
            type="button"
            class=" bg-red-500 text-white rounded-xl hover:shadow-md py-2 px-4"
            x-on:click="delete_all({{$catalog->id}})"
            >
            Delete all Items
            </button>
        </div>
    </div>

</x-modal>
<x-modal name="bulk_edit_image" :show="false" focusable>
    @foreach ($items as $item)
    <div class="p-6">
        <iframe src="/items/{{$item->id}}/bulk_edit_image" width="100%" height="200px" class="rounded-xl border-black border-2"></iframe>
    </div>
    @endforeach
</x-modal>
<script>
    function generate_pdf(id) {
        window.open("/catalogs/"+id+"/pdf-download", "_self");
    }
    function delete_all(id) {
        window.open("/catalogs/"+id+"/delete_all", "_self");
    }
</script>
