@props(['sectionname', 'id'])

<li class="group flex justify-between items-center bg-bgcolor_lightgray border rounded-md">
    <a class="w-full flex items-center px-8 py-6 gap-4" href="{{ route('section.schedule', ['id' => $id, 'return_to' => url()->current()]) }}">
        <img src="{{ asset('assets/icons/shapes.svg') }}" alt="">
        <h2>{{ $sectionname }}</h2>
    </a>
</li>