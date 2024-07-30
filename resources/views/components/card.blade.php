<div {{ $attributes->merge(['class' => 'relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl']) }}>
    @isset($image)
        <div
        class="relative h-56 mx-4 mt-4 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-gray-100 shadow-blue-gray-500/40"
        >
        {{ $image }}
        </div>
    @endisset

    <div class="mx-4 p-2">
        @isset($title)
            <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                {{ $title }}
            </h5>
        @endisset
        @isset($price)
            <p class="block mb-2 font-sans antialiased font-light leading-snug tracking-normal text-blue-gray-700">
                {{ $price }}
            </p>
        @endisset
    </div>
    @isset($buttons)
        <div class="mx-4">
            {{ $buttons }}
        </div>
    @endisset

    {{$slot}}
</div>
