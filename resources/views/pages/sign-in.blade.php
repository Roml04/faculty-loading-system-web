<x-layout :pagetitle="$pagetitle">
    <main class="flex flex-col lg:flex-row h-full">
        <div class="bg-primary flex flex-col justify-center h-full w-full lg:w-1/2 px-24 gap-4">
            <p class='text-txtclr_white text-headline'>STI's Online Schedule</p>
            <p class="text-txtclr_white text-subheadline">One Portal for All Academic Schedules.</p>
        </div>
        <div class="flex justify-center items-center h-1/4 lg:h-full w-full lg:w-1/2 ">
            <a class="flex items-center gap-4 bg-bgcolor_gray px-16 py-4 rounded-sm" href="{{ route('azure.redirect') }}">
                <img src="{{ asset('assets\icons\microsoft.svg') }}" alt="">
                <p class="text-paragraph_bs">Login with Microsoft</p>
            </a>
        </div>
    </main>
</x-layout>