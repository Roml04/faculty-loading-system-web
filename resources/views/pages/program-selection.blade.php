<x-layout :pagetitle="$title">

    @vite(['resources/js/program-selection.js'])
    
    <main class="w-full flex h-fit flex-1">
        @if (session('role') === 'Teacher')
            <section class="h-full px-2 py-8 bg-primary flex flex-col w-0 md:w-fit gap-2">
                <form action="" class="flex flex-col gap-2">
                    @csrf
                    <label for="programs" class="flex items-center hover:bg-primary_hovered active:bg-primary_pressed rounded-full justify-center px-12 py-4 gap-4
                    has-[input:checked]:bg-primary_pressed" href="">
                        <img src="{{ asset('assets/icons/book-white.svg') }}">
                        <input class="hidden" id="programs" name='navigation' value='programs' type="radio" checked>
                        <p class="text-txtclr_white">Programs</p>
                    </label>
                    <label for="teachers" class="flex items-center hover:bg-primary_hovered active:bg-primary_pressed rounded-full justify-center px-12 py-4 gap-4
                    has-[input:checked]:bg-primary_pressed" href="">
                        <img src="{{ asset('assets/icons/user-white.svg') }}">
                        <input class="hidden" id="teachers" name='navigation' value='teachers' type="radio">
                        <p class="text-txtclr_white">Teachers</p>
                    </label>
                </form>
            </section>
        @else
            <section class="h-full bg-primary w-0 md:w-1/12"></section>
        @endif
        
        <section class="w-full h-fit px-4 py-8 flex flex-col gap-8">
            <div class="flex flex-col h-full md:flex-row justify-between gap-4">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/icons/book-black.svg') }}" alt="">
                    <h1>Programs</h1>
                </div>
                <x-molecules.search-bar/>
            </div>
            <div class="flex flex-col gap-8">
                <div class="flex flex-col gap-2">
                    <h2>Tertiary</h2>
                    @if(count($courses) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2.5">
                            @foreach ($courses as $item)
                                <x-molecules.program-card :id="$item->id" :level="$item->level" :programname="$item->program_name" :path="$item->path"/>
                            @endforeach
                        </div>
                    @else
                        <x-molecules.index-message :message="'There are no available schedules for the Tertiary level'"/>
                    @endif
                </div>
                <div class="flex flex-col gap-2">
                    <h2>Senior High School</h2>
                    @if(count($strands) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2.5">
                            @foreach ($strands as $item)
                                <x-molecules.program-card :id="$item->id" :level="$item->level" :programname="$item->program_name" :path="$item->path"/>
                            @endforeach
                        </div>
                    @else
                        <x-molecules.index-message :message="'There are no available schedules for the Senior High level'"/>
                    @endif
                </div>
            </div>
        </section>
    </main>
</x-layout>
