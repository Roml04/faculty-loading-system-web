@php
    $pagetitle = "Access Denied";
    $errortitle = "403 - Access Denied";
    $errormessage = "You do not have access to this resource.";
@endphp

<x-layout :pagetitle="$pagetitle">
    <main class="flex flex-col h-full">
        <div class="flex flex-col items-center bg-state_danger_d">
            <h1 class="py-8 text-txtclr_white">{{ $errortitle }}</h1>
        </div>
        <div class="flex flex-col items-center py-8 gap-8">
            <p>{{ $errormessage }}</p>
            <a href="{{ url('/') }}" class="text-txtclr_black hover:underline hover:text-txtclr_primary rounded-md">Go back</a>
        </div>
    </main>
</x-layout>