<div {{ $attributes->merge(['class' => 'relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl']) }}>
    @isset($image)
        <div
        class="overflow-hidden text-white bg-clip-border rounded-t-xl bg-gray-100 shadow-blue-gray-500/40 w-full h-60 object-cover"
        >
        {{ $image }}
        </div>
    @endisset

    @isset($title)
        <h5 class="mx-4 py-2 block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-black">
            {{ $title }}
        </h5>
    @endisset
    @isset($price)
        <p class="mx-4 py-2 block mb-2 font-sans antialiased font-light leading-snug tracking-normal text-gray-700">
            {{ $price }}
        </p>
    @endisset

    @isset($buttons)
        <div class="mx-4">
            {{ $buttons }}
        </div>
    @endisset

    {{$slot}}
</div>
