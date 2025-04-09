@props(['inputvalue' => null])

<form class="flex gap-[0.5em]" action="{{ route('search') }}">
    @csrf
    <input class="outline-none w-full px-[1em] py-[0.75em] rounded-md border border-stroke_lightblue" name="search_query" value="{{ $inputvalue }}" type="text" placeholder="Search Schedule" required>
    <button class="hidden sm:block cstm-button px-[1.5em] py-[0.75em] rounded-md bg-primary" type="submit" value="">
        <p class="text-txtclr_white">Search</p>
    </button>
</form>