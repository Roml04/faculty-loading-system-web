@props(['id' => null, 'level' => null, 'programname' => 'Unknown', 'path' => 'assets/images/no-img.jpg'])

<style>
    .program-card {
        aspect-ratio: 3/4;
        transition: transform 100ms ease-in-out;
    }
    .program-card::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        inset: 0;
        background: var(--lightgray-gradient);
    }

    .program-card > * {
        z-index: 1;
    }
    .program-card:hover, .program-card::before {
        transform: scale(1.025);
    }
</style>

<a href="{{ route('sections', ['id' => $id, 'return_to' => url()->current()]) }}" style="background: url({{ asset($path) }}); background-size: cover; background-position: center;" class="program-card relative">
    <div class="h-full flex flex-col justify-end px-4 py-6">
        {{-- <img src="{{ asset('assets/icons/dice.svg') }}" class="w-fit icons-def z-10"> --}}
        <h2 class="z-10">{{ $programname }}</h2>
    </div>
</a>