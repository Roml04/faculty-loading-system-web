<x-layout>
    <main class="w-full flex flex-col h-fit gap-8 px-20 py-10">
        <a class="flex items-center gap-4" href="{{ route('home') }}">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.44067 14.9406C4.85474 15.5266 4.85474 16.4781 5.44067 17.0641L12.9407 24.5641C13.5266 25.15 14.4782 25.15 15.0641 24.5641C15.65 23.9781 15.65 23.0266 15.0641 22.4406L10.1188 17.5H24.5C25.3297 17.5 26 16.8297 26 16C26 15.1703 25.3297 14.5 24.5 14.5H10.1235L15.0594 9.55937C15.6454 8.97344 15.6454 8.02187 15.0594 7.43594C14.4735 6.85 13.5219 6.85 12.936 7.43594L5.43599 14.9359L5.44067 14.9406Z" fill="black"/>
            </svg>
            {{-- Needs to be dynamic --}}
            <h1>{{ $sectionname }}</h1>
        </a>
        <p>test</p>
    </main>
</x-layout>