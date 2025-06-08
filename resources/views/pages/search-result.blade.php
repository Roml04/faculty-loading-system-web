<x-layout :pagetitle="$pagetitle">

    <main class="flex flex-col h-full gap-8">
        <section style="background: url('{{ asset('assets/images/banner.webp') }}')" class="banner-section flex flex-col w-full px-4 py-12 lg:px-20">
            <x-molecules.search-bar :inputvalue="$search_query"/>
        </section>
        <section class="w-full flex flex-col h-full px-4 lg:px-20 gap-2">
            <a href="{{ route('home') }}" class="w-fit p-2 flex items-center gap-4">
                <svg width="29" height="32" viewBox="0 0 29 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.94067 14.9407C3.35474 15.5267 3.35474 16.4782 3.94067 17.0642L11.4407 24.5642C12.0266 25.1501 12.9782 25.1501 13.5641 24.5642C14.15 23.9782 14.15 23.0267 13.5641 22.4407L8.6188 17.5001H23C23.8297 17.5001 24.5 16.8298 24.5 16.0001C24.5 15.1704 23.8297 14.5001 23 14.5001H8.62349L13.5594 9.55947C14.1454 8.97353 14.1454 8.02197 13.5594 7.43604C12.9735 6.8501 12.0219 6.8501 11.436 7.43604L3.93599 14.936L3.94067 14.9407Z" fill="black"/>
                </svg>
                <p>Back</p>
            </a>
            <div class="flex flex-col gap-4">
                <h1>Results for '{{ $search_query }}'</h1>

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
                    <x-molecules.index-message :message="'No available sections matched your search'"/>
                @endif

                
            </div>
        </section>
    </main>
    <x-organisms.footer/>
</x-layout>