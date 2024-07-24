<div {{$attributes->merge(['class' => "max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8"])}}>
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 transition-all duration-300 hover:shadow-md">
        {{$slot}}
    </div>
</div>

{{-- <div {{$attributes->merge(['class' => "bg-gray-50 border border-gray-200 rounded p-6"])}}>
    {{$slot}}
</div> --}}
