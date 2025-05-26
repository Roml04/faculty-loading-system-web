@props(['teachername' => 'Unknown', 'id'])

<li class="group flex justify-between items-center bg-bgcolor_lightgray border border-stroke_lightblue rounded-md">
    <a class="w-full flex justify-between items-center px-8 py-6" href="{{ route('teacher.schedule', ['id' => $id]) }}">
        <h2>{{ $teachername }}</h2>
        <svg class="hidden group-hover:flex" width="1.75rem" height="1.75rem" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 16C6 13.5 8 8 16 8C24 8 26 13.5 26 16C26 18.5 24 24 16 24C8 24 6 18.5 6 16ZM16 19C18 19 19 17.6569 19 16C19 14.3432 18 13 16 13C14 13 13 14.3432 13 16C13 17.6569 14 19 16 19Z" fill="black"/>
        </svg>
    </a>    
</li>