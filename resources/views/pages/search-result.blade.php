<x-layout :pagetitle="$pagetitle">

    <main class="flex flex-col h-full gap-4">
        <section class="flex flex-col md:flex-row justify-between gap-4 px-4 py-8">
            <div class="flex items-center gap-4 overflow-clip">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/icons/angle-left-black.svg') }}" alt="">
                </a>
                <h1>Search Results for '{{ $search_query }}'</h1>
            </div>
            <x-molecules.search-bar/>
        </section>
        <section class="w-full flex flex-col h-full px-2 lg:px-4 gap-8">
            @if ($has_teacher or $has_section)
                <div @class(['flex', 'gap-2', 'flex-col', 'hidden' => !($has_section)])>
                    <h2>Sections</h2>
                    <ul class="flex flex-col gap-2">
                        @foreach ($section_results as $item)
                            <x-molecules.section-list :sectionname="$item->section_name" :id="$item->id"/>
                        @endforeach
                    </ul>
                </div>
                <div @class(['flex', 'gap-2', 'flex-col', 'hidden' => !($has_teacher)])>
                    <h2>Teachers</h1>
                    <ul>
                        @foreach($teacher_results as $item)
                            <x-molecules.teacher-list :teachername="$item->teacher_name" :id="$item->id"/>
                        @endforeach
                    </ul>
                </div>
            @else
                <x-molecules.index-message :message="'No available schedules matched your search'"/>
            @endif
        </section>
    </main>
</x-layout>