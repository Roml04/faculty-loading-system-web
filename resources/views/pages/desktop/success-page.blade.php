@php
    $pagetitle = 'Registration Successful';
@endphp
<x-layout :pagetitle="$pagetitle">
    <main class="flex justify-center items-center">
        <div class="w-full flex flex-col items-center bg-state_success_d">
            <h1 class="py-8 text-txtclr_white">{{ $message }}</h1>
        </div>
    </main>

    <script defer>
        console.log("fls-sti://callback?token={{ urlencode($apiToken) }}")

        document.addEventListener("DOMContentLoaded", () => {
            window.location.href =
                "fls-sti://callback?token={{ urlencode($apiToken) }}";
        });
    </script>
</x-layout>