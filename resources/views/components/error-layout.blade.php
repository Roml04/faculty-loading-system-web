@props(['errortitle' => 'Untitled', 'errormessage' => '...'])

<main class="flex flex-col justify-center items-center h-full bg-bgcolor_lightgray">
    <div class="flex flex-col bg-bgcolor_white rounded-md w-1/2 overflow-clip">
        <div class="flex flex-col bg-state_danger_d px-8">
            <h1 class="py-8 text-txtclr_white">{{ $errortitle }}</h1>
        </div>
        <div class="flex flex-col justify-center p-8 gap-8">
            <p>{{ $errormessage }}</p>
        </div>
        <div class="flex justify-center p-8">
            <a href="{{ url('/board') }}" class="text-txtclr_black hover:underline hover:text-txtclr_primary rounded-md">Go back to the homepage</a>
        </div>
    </div>
</main>