@props(['teachername' => 'Unknown', 'id'])

<li class="group flex justify-between items-center bg-bgcolor_lightgray border rounded-md">
    <a class="w-full flex items-center px-8 py-6 gap-4" href="{{ route('teacher.schedule', ['id' => $id]) }}">
        <img src="{{ asset('assets/icons/user-black.svg') }}" alt="">
        <h2>{{ $teachername }}</h2>
    </a>
</li>