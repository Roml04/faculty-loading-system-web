@props(['id' => null, 'level' => null, 'programname' => 'Unknown', 'path' => 'assets/images/cularts.jpg'])

<style>
    .program-card {
        aspect-ratio: 3/4;
        position: relative;
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
    .program-card:hover {
        transform: scale(1.025);
    }
</style>

<div style="background: url({{ asset($path) }}); background-size: cover; background-position: center;" class="program-card flex flex-col justify-end gap-2 p-3 border border-cstm_bluishgray rounded-md">
    <h2>{{ $programname }}</h2>
    <a href="{{ route('sections', ['itemid' => $id]) }}" class="cstm-button flex justify-center p-[1em] rounded-md bg-primary text-white">
        <p>Browse Schedule</p>
    </a>
</div>