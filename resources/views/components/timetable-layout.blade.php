@vite(['resources/css/app.css'])
<x-layout :pagetitle="$pagetitle">
    <main class="p-4 w-full">
        <div>
            <h1 class="py-2">{{ $pagetitle }}</h1>
            <div class="flex w-full h-full">
                @foreach($formattedSchedules as $day => $timeslots)
                    <div class="w-1/6 flex flex-col mx-1 h-full">
                        <h3 class="text-center p-2 bg-bgcolor_lightgray text-txtclr_black rounded-md">{{ $day }}</h3>
                        @foreach($timeslots as $timeslot)
                            <div class="mt-2 p-1 flex flex-col bg-bgcolor_bluishlightgray rounded-md">
                                <h3 class="p-1 text-center font-bold w-full bg-primary text-txtclr_white rounded-md">{{ $timeslot['title'] }}</h3>
                                <p class="text-paragraph_sm text-center">{{ $timeslot['extendedProps']['roomType'] }}</p>
                                <p class="text-paragraph_sm text-center">{{ $timeslot['extendedProps']['roomNumber'] }}</p>
                                <p class="text-paragraph_sm text-center">{{ $timeslot['startTime'] . ' - ' . $timeslot['endTime'] }}</p>
                                <p class="text-paragraph_sm text-center">{{ $timeslot['extendedProps']['teacherName'] }}</p>
                            </div>
                        @endforeach
                        <div class="mt-2 px-2 py-4 bg-bgcolor_lightgray rounded-md flex-1"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</x-layout>
