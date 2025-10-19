@php
    $pagetitle = 'Existing Account';
@endphp
<x-layout :pagetitle="$pagetitle">
    <main class="flex flex-col justify-center items-center h-full bg-bgcolor_lightgray">
        <div class="flex flex-col bg-bgcolor_white rounded-md w-1/2 overflow-clip">
            <div class="flex flex-col bg-state_danger_d px-8">
                <h1 class="py-8 text-txtclr_white">Duplicate Email Address</h1>
            </div>
            <div class="flex flex-col justify-center p-8 gap-8">
                <p>An account with this email address already exists. Please use a different email or try signing in instead</p>
            </div>
            <div class="flex justify-center p-8">
                <a href="{{ route('register', ['source' => 'desktop']) }}" class="text-txtclr_black hover:underline hover:text-txtclr_primary rounded-md">Go back to the homepage</a>
            </div>
        </div>
    </main>
</x-layout>