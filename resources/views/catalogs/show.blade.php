<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __($catalog->name) }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        <div class="flex flex-col items-center">
            <div class="w-full mt-1">
                <img
                    class="w-full h-full object-cover rounded-lg shadow-md"
                    src="{{ $catalog->logo ? asset('storage/'.$catalog->logo) : asset('images/no-image.png') }}"
                    alt="Catalog Logo"
                />
            </div>
        </div>
        <div class="flex flex-col space-y-4">
            <div class="font-bold text-2xl">
                Description
            </div>

            <div class="text-gray-700 h-full">
                {{ $catalog->description }}
            </div>

            <button
                type="button" onclick="show_items({{$catalog->id}})"
                class="w-full bg-black text-white py-2 px-4 hover:bg-gray-800 rounded-xl shadow-md transition duration-200"
            >
                Show Items
            </button>
            @can('modify_catalog', $catalog)
                <button
                type="button" onclick="edit_catalog({{$catalog->id}})"
                class="w-full bg-black text-white py-2 px-4 my-4 hover:shadow-md rounded-xl">
                    Edit Catalog
                </button>

                <button
                type="button"
                class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-xl"
                x-data=""
                x-on:click="$dispatch('open-modal', 'confirm-catalog-deletion-{{$catalog->id}}')"
                >
                Delete Catalog
                </button>
            @endcan
        </div>
    </div>
</x-app-layout>

<!-- Confirmation Modal -->
<x-modal name="confirm-catalog-deletion-{{$catalog->id}}" :show="false" focusable>
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

            <form action="/catalogs/{{ $catalog->id }}" method="POST" class="ml-3">
                @csrf
                @method('DELETE')
                <x-danger-button type="submit">
                    Delete Catalog
                </x-danger-button>
            </form>
        </div>
    </div>
</x-modal>


<script>
    function show_items(id) {
        window.open("/catalogs/"+id+"/items", "_self");
    }
    function edit_catalog(id) {
        window.open("/catalogs/"+id+"/edit", "_self");
    }
</script>
