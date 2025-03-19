<x-layout>
    <main class="w-full flex flex-col h-fit gap-8">
        <section style="background: url('{{ asset('assets/images/banner.webp') }}')" class="banner-section flex flex-col w-full px-20 py-10">
            <x-molecules.search-bar/>
        </section>
        <div class="w-full flex flex-col h-full px-20 gap-2">
            <div class="w-fit p-2 flex items-center gap-4">
                <a href="{{ route('home') }}">
                    <svg width="29" height="32" viewBox="0 0 29 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.94067 14.9407C3.35474 15.5267 3.35474 16.4782 3.94067 17.0642L11.4407 24.5642C12.0266 25.1501 12.9782 25.1501 13.5641 24.5642C14.15 23.9782 14.15 23.0267 13.5641 22.4407L8.6188 17.5001H23C23.8297 17.5001 24.5 16.8298 24.5 16.0001C24.5 15.1704 23.8297 14.5001 23 14.5001H8.62349L13.5594 9.55947C14.1454 8.97353 14.1454 8.02197 13.5594 7.43604C12.9735 6.8501 12.0219 6.8501 11.436 7.43604L3.93599 14.936L3.94067 14.9407Z" fill="black"/>
                    </svg>
                </a>
                <h1>{{ $program_name }}</h1>
            </div>
            @if (count($sections) !== 0)
                <ul class="flex flex-col gap-2">
                    @foreach ($sections as $item)
                        <x-molecules.section-list :sectionname="$item->section_name" :sectionid="$item->id"/>
                    @endforeach
                </ul>
            @else
                <div class="flex justify-center bg-bgcolor_lightgray py-8 rounded-md">
                    <p class="text-txtclr_gray">No available schedules match your search</p>
                </div>
            @endif
        </div>
    </main>
    <x-organisms.footer/>
</x-layout>