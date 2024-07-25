@props(['catalog'])

<x-card>
    <div class="flex">
        <img
            class="w-48 mr-6 md:block"
            src="{{$catalog->logo ? asset('storage/'.$catalog->logo) : asset('images/no-image.png')}}"
            alt="Magazine Logo"/>
        <div>
            <h3 class="text-2xl font-bold">
                <a href="/catalogs/{{$catalog->id}}">{{$catalog->name}}</a>
            </h3>
            {{-- <div class="text-l text-gray-400 font-bold ">{{$catalog->description}}</div> --}}

            <div class="justify-end">
                <button
                type="button" onclick="href({{$catalog['id']}})"
                class="w-full bg-black text-white py-2 px-4 my-4 hover:shadow-md rounded">
                    Edit Catalog
                </button>

            </div>

            <div class="justify-end">
                <button
                type="button"
                class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                x-data=""
                x-on:click="$dispatch('open-modal', 'confirm-catalog-deletion')"
                >
                Delete Catalog
                </button>
            </div>
        </div>

    </div>
</x-card>

<!-- Confirmation Modal -->
<x-modal name="confirm-catalog-deletion" :show="false" focusable>
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
    function href(id) {
        window.open("/catalogs/"+id+"/edit", "_self");
    }
</script>






{{-- <!-- Delete Directly Button -->
<form action="/catalogs/{{ $catalog->id }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
        Delete Catalog
    </button>
</form> --}}
<!-- Delete Button with Modal Confirmation -->
