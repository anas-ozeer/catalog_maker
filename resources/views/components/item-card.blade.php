@props(['item', 'edit'])
<x-card class="m-6 w-72">
    @if($edit)
        <x-slot name="image">
            <form action="/items/{{$item->id}}/bulk_update_image_ajax" method="POST" id="image_submit_{{$item->id}}" enctype="multipart/form-data" ondragover="event.preventDefault()" ondrop="handleDrop(event, {{$item->id}})"enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <label for="item_image_{{$item->id}}" class="cursor-pointer">
                    <div class="absolute top-2 right-2 bg-transparent text-black rounded-full p-2 hover:shadow-xl">
                        <i class="fas fa-edit"></i>
                    </div>
                    <img id="item_image_preview_{{$item->id}}" src="{{ $item->image ? asset($item->image) : asset('images/no-image.png') }}" alt="Edit Image">
                </label>
                <input id="item_image_{{$item->id}}" type="file" name="item_image_{{$item->id}}" accept="image/*" class="hidden" onchange="submit_form({{$item->id}})">
            </form>
        </x-slot>
    @else
        <x-slot name="image">
            <img src="{{ $item->image ? asset($item->image) : asset('images/no-image.png') }}" alt="An image is here">
        </x-slot>
    @endif

    <x-slot name="title">
        <a href="/items/{{$item->id}}">{{ $item->name }}</a>
    </x-slot>

    <x-slot name="price">
        Rs{{ $item->price }}
    </x-slot>
</x-card>


<script>
    function submit_form(id) {
        const form = document.getElementById('image_submit_'+id);
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const imgElement = document.getElementById('item_image_preview_'+id);
                imgElement.src = data.image_url; // Update the image preview with the new image URL
            } else {
                alert('Failed to upload image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred.');
        });
    }

    function handleDrop(event, id) {
        event.preventDefault();

        const form = document.getElementById('image_submit_'+id);
        const input = document.getElementById('item_image_'+id);

        // Handle dropped files
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            input.files = files; // Assign the files to the input
            submit_form(id); // Automatically submit the form
        }
    }
</script>








