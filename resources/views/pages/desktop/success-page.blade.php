@php
    $pagetitle = 'Registration Successful';
@endphp
<x-layout :pagetitle="$pagetitle">
    <main class="flex flex-col justify-center items-center h-full bg-bgcolor_lightgray">
        <div class="flex flex-col bg-bgcolor_white rounded-md w-1/2 overflow-clip">
            <div class="flex flex-col bg-state_success_d px-8">
                <h1 class="py-8 text-txtclr_white">{{ $action }} Complete</h1>
            </div>
            <div class="flex flex-col justify-center p-8 gap-8">
                <p>{{ $action }} was successful and your details have been saved. You may now close this tab and proceed.</p>
            </div>
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