@php

    // Mock database
    $courses = [
        ["programname" => "Computer Science", "pathtopic" => 'assets/images/cs.jpg'], 
        ["programname" => "Information Technology", "pathtopic" => 'assets/images/it.jpg'], 
        ["programname" => "Computer Engineering", "pathtopic" => 'assets/images/cpe.jpg'], 
        ["programname" => "Multimedia Arts", "pathtopic" => 'assets/images/mma.jpg'],
        ["programname" => "Tourism Management", "pathtopic" => 'assets/images/tm.jpg']
    ];

    $strands = [
        ["strandname" => "ABM", "pathtopic" => 'assets/images/abm.jpg'], 
        ["strandname" => "STEM", "pathtopic" => 'assets/images/stem.jpg'], 
        ["strandname" => "Culinary Arts", "pathtopic" => 'assets/images/cularts.jpg'], 
        ["strandname" => "ITMAWD", "pathtopic" => 'assets/images/itmawd.jpg']
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])

        <style>
            .banner-section {
                background-size: cover !important;
                background-position: top !important;
                position: relative;
            }
            .banner-section::after {
                content: '';
                inset: 0;
                position: absolute;
                width: 100%;
                height: 100%;
                background: var(--primary-gradient);
            }
            .banner-section > * {
                z-index: 1;
            }
        </style>
    </head>
    <body class="flex flex-col items-center justify-center gap-8">
        <section style="background: url('{{ asset('assets/images/banner.jpg') }}')" class="banner-section flex flex-col w-full p-20 gap-20">
            <div class="flex flex-col text-txtclr_primary">
                <p class="text-subheadline">STI Faculty Loading System's</p>
                <p class="text-headline">SCHEDULE VIEWER</p>
            </div>
            <x-molecules.search-bar/>
        </section>
        <main class="w-full flex flex-col h-full px-20 gap-8">
            <section class="w-full">
                <h2 class="mb-4">TERTIARY</h2>
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($courses as $item)
                        <x-molecules.program-card :path="$item['pathtopic']" :programname="$item['programname']"/>
                    @endforeach
                </div>
            </section>
            <section class="w-full">
                <h2 class="mb-4">SENIOR HIGH SCHOOL</h2>
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($strands as $item)
                        <x-molecules.program-card :programname="$item['strandname']" :path="$item['pathtopic']" />
                    @endforeach
                </div>
            </section>
        </main>
        <x-organisms.footer/>
    </body>
</html>
