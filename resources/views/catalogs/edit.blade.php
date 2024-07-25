<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <x-card class="p-5 w-1/2">
            <header class="text-center">
                <h2 class="text-2xl font-bold mb-1">
                    Edit the Catalog
                </h2>
                <p class="mb-4">Please edit the information about the Catalog</p>
            </header>

            <form method="POST" action="/catalogs/{{$catalog['id']}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-6">
                    <x-input-label for="name" >Name</x-input-label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{ $catalog['name'] }}" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <x-input-label for="description" >Description</x-input-label>
                    <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10">{{ $catalog['description']}}</textarea>
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
                        value="{{$catalog['logo']}}"
                    />
                    @error('logo')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button class="rounded py-2 px-4 bg-black text-white" type="submit">
                        Edit Catalog
                    </button>

                    <a href="/catalogs/index" class="text-black ml-4">Back</a>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
