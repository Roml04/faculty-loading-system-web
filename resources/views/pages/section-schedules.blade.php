<x-layout :pagetitle="$programname">
    <main class="w-full flex flex-col h-fit gap-4">
        <section class="flex flex-col md:flex-row justify-between gap-4 px-4 py-8">
            <div class="flex items-center gap-4 overflow-clip">
                <a href="{{ $return_to }}">
                    <img src="{{ asset('assets/icons/angle-left-black.svg') }}" alt="">
                </a>
                <h1>{{ $programname }}</h1>
            </div>
            <x-molecules.search-bar/>
        </section>
        <section class="w-full flex flex-col h-full px-2 lg:px-4 gap-8">
            @if (count($sections) !== 0)
                <ul class="flex flex-col gap-2">
                    @foreach ($sections as $item)
                        <x-molecules.section-list :sectionname="$item->section_name" :id="$item->id"/>
                    @endforeach
                </ul>
            @else
                <x-molecules.index-message :message="'No available sections'"/>
            @endif
        </section>
    </main>
</x-layout>