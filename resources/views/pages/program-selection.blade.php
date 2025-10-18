<x-layout :pagetitle="$title">

    @vite(['resources/js/program-selection.js'])

    <main class="w-full flex h-fit md:flex-1">

        {{-- WEB: Nav Bar --}}
        @if (session('role') === 'Teacher')
            <section class="h-full px-2 py-8 bg-primary hidden md:flex flex-col w-0 md:w-fit gap-2">
                <form id="webNavBar" action="" class="flex flex-col gap-2">
                    @csrf
                </form>
            </section>
        @else
            <section section class="h-full bg-primary w-0 md:w-1/12"></section>
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
                    @endif
                </div>
                <x-molecules.search-bar />
            </div>

            {{-- Programs --}}
            <section id="programscontainer" class="w-full h-fit px-4 py-8 flex flex-col gap-8">

                <div class="h-[80vh] flex flex-col gap-8 overflow-y-scroll">
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
                        <div class="h-[80vh] flex flex-col sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2.5 overflow-y-scroll">
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