<x-layout :pagetitle="$title">

    @vite(['resources/js/program-selection.js'])

    <main class="w-full flex h-fit md:flex-1">

        {{-- WEB: Nav Bar --}}
        @if (session('role') === 'Teacher')
            <section class="h-full px-2 bg-primary hidden md:flex flex-col justify-between items-center w-0 md:w-fit gap-2">
                <div class="flex flex-col items-center">
                    <img class="w-24 py-4" src="{{ asset('assets/images/sti-logo.webp') }}" alt="">    
                    <form id="webNavBar" action="" class="flex flex-col gap-2">
                        @csrf
                    </form>
                </div>
                <a href="{{ route('logout') }}" class="mb-6 flex items-center active:bg-bgcolor-gray rounded-full justify-center w-full py-3 gap-4 active:bg-primary_pressed">
                    <img src="{{ asset('assets/icons/log-out-white.svg') }}" alt="">
                    <p class="text-txtclr_white">Log out</p>
                </a>
            </section>
        @else
            <section section class="hidden h-full bg-primary md:flex flex-col justify-between items-center md:w-1/12 p-2">
                <img class="hidden md:block h-fit" src="{{ asset('assets/images/sti-logo.webp') }}" alt="">
                <a href="{{ route('logout') }}" title="Log out" class="mb-6 flex items-center active:bg-bgcolor-gray rounded-full justify-center aspect-square py-3 gap-4 active:bg-primary_pressed">
                    <img src="{{ asset('assets/icons/log-out-white.svg') }}" alt="">
                </a>
            </section>
        @endif

        <div class="flex flex-col w-full">

            <div class="flex flex-col justify-between md:flex-row gap-4 px-4 pt-8">
                <div class="flex justify-between">
                    <div class="flex gap-4">
                        <img id="sectionIcon" class="icons-def" src="{{ asset('assets/icons/book-black.svg') }}" alt="">
                        <h1 id="sectionTitle">Programs</h1>
                    </div>

                    {{-- MOBILE: Nav Bar --}}
                    @if(session('role') === 'Teacher')
                        <div id="navPopUpButton" class="flex">
                            <form id="nav-popup" action="" class="hidden z-10 bg-bgcolor_lightgray border border-bgcolor_gray rounded-md flex flex-col absolute w-min right-0 top-10">
                                @csrf
                            </form>
                            <img src="{{ asset('assets/icons/chevron-down.svg') }}" class="md:hidden">
                        </div>
                    @else
                        <div>
                            <a href="{{ route('logout') }}" class="flex items-center active:bg-bgcolor-gray rounded-full justify-center w-full">
                                <img class="block md:hidden icons-def" src="{{ asset('assets/icons/log-out-black.svg') }}" alt="">
                            </a>
                        </div>
                    @endif
                </div>
                <x-molecules.search-bar />
            </div>

            {{-- Programs --}}
            <section id="programscontainer" class="w-full h-fit px-4 py-8 flex flex-col gap-8">

                <div class="h-[80vh] flex flex-col gap-8 overflow-y-scroll overflow-x-hidden">
                    <div class="flex flex-col gap-2">
                        <h2>Tertiary</h2>
                        @if(count($courses) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2.5">
                            @foreach ($courses as $item)
                            <x-molecules.program-card :id="$item->id" :level="$item->level" :programname="$item->program_name" :path="$item->path" />
                            @endforeach
                        </div>
                        @else
                        <x-molecules.index-message :message="'There are no available schedules for the Tertiary level'" />
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <h2>Senior High School</h2>
                        @if(count($strands) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2.5">
                            @foreach ($strands as $item)
                            <x-molecules.program-card :id="$item->id" :level="$item->level" :programname="$item->program_name" :path="$item->path" />
                            @endforeach
                        </div>
                        @else
                        <x-molecules.index-message :message="'There are no available schedules for the Senior High School level'" />
                        @endif
                    </div>
                </div>
            </section>

            {{-- Teachers --}}
            <section id="teacherscontainer" class="hidden w-full h-fit px-4 py-8 flex flex-col gap-8">
                <div class="flex flex-col gap-8">
                    <div class="flex flex-col gap-2">
                        @if(count($teachers) > 0)
                        <div class="h-[80vh] flex flex-col sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2.5 overflow-y-scroll overflow-x-hidden">
                            @foreach ($teachers as $item)
                            <x-molecules.teacher-list :id="$item->id" :teachername="$item->teacher_name" />
                            @endforeach
                        </div>
                        @else
                        <x-molecules.index-message :message="'There are no available schedules for Teachers'" />
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </main>
</x-layout>