@props(['inputvalue' => null])

<form class="w-full md:w-1/3" action="{{ route('search') }}">
    @csrf
    <label for="search" class="bg-bgcolor_lightgray flex items-center justify-between rounded-full px-6 py-2 gap-2">
        <input id="search" class="w-full bg-transparent focus:outline-none" type="text" placeholder="Search Schedules" value="{{ $inputvalue }}" required>
        <button type="submit">
            <img src="{{ asset('assets/icons/search.svg') }}" alt="">
        </button>
    </label>
</form>