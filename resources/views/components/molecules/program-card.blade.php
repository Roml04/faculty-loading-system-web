@props(['programname' => 'Unknown', 'path' => 'assets/images/cularts.jpg'])

<style>
    .program-card {
        aspect-ratio: 3/4;
        position: relative;
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
</style>

<div style="background: url({{ asset($path) }}); background-size: cover; background-position: center" class="program-card flex flex-col justify-end border-[1px] border-cstm_bluishgray rounded-md p-3 gap-2">
    <h2>{{ $programname }}</h2>
    <x-atoms.ctabutton/>
</div>