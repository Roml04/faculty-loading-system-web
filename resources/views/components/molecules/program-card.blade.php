@props(['id' => null, 'level' => null, 'programname' => 'Unknown', 'path' => 'assets/images/no-img.jpg'])

<style>
    .program-card {
        aspect-ratio: 19/20;
        transition: transform 100ms ease-in-out;
    }

    .program-card > * {
        z-index: 1;
    }
    .program-card:hover {
        transform: scale(1.025);
    }
</style>

<a href="{{ route('sections', ['id' => $id, 'return_to' => url()->current()]) }}" class="program-card bg-bgcolor_lightgray flex flex-col justify-between px-4 py-6">
    <img src="{{ asset('assets/icons/dice.svg') }}" class="w-fit">
    <h2>{{ $programname }}</h2>
</a>