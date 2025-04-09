<x-layout :pagetitle="$title">
    
    <main class="w-full flex flex-col h-fit gap-8">
        <section style="background: url('{{ asset('assets/images/banner.webp') }}')" class="banner-section flex flex-col w-full px-4 py-12 lg:p-20 gap-20">
            <div class="flex flex-col text-txtclr_primary">
                <p class="text-subheadline">STI Faculty Loading System's</p>
                <p class="text-headline">SCHEDULE VIEWER</p>
            </div>
            <x-molecules.search-bar/>
        </section>
        <section class="programs-container flex flex-col h-full px-4 lg:px-20 gap-8">
            <div class="w-full">
                <h2 class="mb-4">TERTIARY</h2>
                <div class="program-card-container grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-2">
                    @foreach ($courses as $item)
                        <x-molecules.program-card :id="$item->id" :level="$item->level" :programname="$item->program_name" :path="$item->path"/>
                    @endforeach
                </div>
            </div>
            <div class="w-full">
                <h2 class="mb-4">SENIOR HIGH SCHOOL</h2>
                <div class="program-card-container grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-2">
                    @foreach ($strands as $item)
                        <x-molecules.program-card :id="$item->id" :level="$item->level" :programname="$item->program_name" :path="$item->path"/>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    <x-organisms.footer/>
</x-layout>
