<x-layout :pagetitle="$title">

    @vite(['resources/js/program-selection.js'])
    
    <main class="w-full flex flex-col h-fit gap-8">
        <section style="background: url('{{ asset('assets/images/banner.webp') }}')" class="banner-section flex flex-col w-full px-4 py-12 lg:p-20 gap-20">
            <div class="flex flex-col text-txtclr_primary">
                <p class="text-subheadline">STI Faculty Loading System's</p>
                <p class="text-headline">SCHEDULE VIEWER</p>
            </div>
            @if (count($courses) > 0 || count($strands) > 0)
                <x-molecules.search-bar/>
            @endif
        </section>
        <section class="programs-container px-4 lg:px-20 flex flex-col gap-8">
            @if(session('role') === 'Teacher')
                <form class="flex justify-center w-full md:w-3/4 md:mx-auto">
                    @csrf
                    <div class="group cursor-pointer w-full h-12 rounded-md 
                        has-[input:checked]:bg-primary
                        has-[input:checked]:text-white">
                        <input class="peer hidden" id="programs" name='navigation' value='programs' type="radio" checked>
                        <label class="cursor-pointer w-full h-full flex justify-center items-center" for="programs">Programs</label>
                    </div>
                    <div class="group cursor-pointer w-full h-12 rounded-md 
                        has-[input:checked]:bg-primary
                        has-[input:checked]:text-white">
                        <input class="peer hidden" id="teachers" name='navigation' value='teachers' type="radio">
                        <label class="cursor-pointer w-full h-full flex justify-center items-center" for="teachers">Teachers</label>
                    </div>
                </form>
            @endif
            <div id="programscontainer" class="flex flex-col h-full gap-8">
                <div class="w-full">
                    <h2 class="mb-4">TERTIARY</h2>
                    @if(count($courses) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
                            @foreach ($courses as $item)
                                <x-molecules.program-card :id="$item->id" :level="$item->level" :programname="$item->program_name" :path="$item->path"/>
                            @endforeach
                        </div>
                    @else
                        <x-molecules.index-message :message="'There are no available schedules for the Tertiary level'"/>
                    @endif  
                </div>
                <div class="w-full">
                    <h2 class="mb-4">SENIOR HIGH SCHOOL</h2>
                    @if(count($strands) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
                            @foreach ($strands as $item)
                                <x-molecules.program-card :id="$item->id" :level="$item->level" :programname="$item->program_name" :path="$item->path"/>
                            @endforeach
                        </div>
                    @else
                        <x-molecules.index-message :message="'There are no available schedules for the Senior High level'"/>
                    @endif
                </div>
            </div>
            <div id="teacherscontainer" class="w-full hidden">
                <h2 class="mb-4">TEACHERS</h2>
                @if(count($teachers) > 0)
                    <ul class="flex flex-col gap-2">
                        @foreach ($teachers as $item)
                            <x-molecules.teacher-list :id="$item->id" :teachername="$item->teacher_name"/>
                        @endforeach
                    </ul>
                @else
                    <x-molecules.index-message :message="'There are no teachers available'"/>
                @endif  
            </div>
        </section>
    </main>
    <x-organisms.footer/>
</x-layout>
