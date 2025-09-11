@php
    $pagetitle = 'Existing Account';
@endphp
<x-layout :pagetitle="$pagetitle">
    <main class="flex justify-center items-center">
        <div class="w-full flex flex-col items-center bg-state_danger_d">
            <h1 class="py-8 text-txtclr_white">An account with this email address already exists.</h1>
        </div>
    </main>
</x-layout>