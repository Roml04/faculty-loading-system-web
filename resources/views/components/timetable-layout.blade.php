<style>
    .table-data {
        width: 15%;
        text-align: center; 
    }

    .time {
        text-align: center;
    }

    table {
        
    }
</style>


@vite(['resources/css/app.css'])

<main class="p-4">
    <table class="border border-black divide-x divide-y divide-black" width="100%" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th class="table-data">Monday</th>
                <th class="table-data">Tuesday</th>
                <th class="table-data">Wednesday</th>
                <th class="table-data">Thursday</th>
                <th class="table-data">Friday</th>
                <th class="table-data">Saturday</th>
            </tr>
        </thead>
        <tbody class="divide-x divide-y divide-black">
            @foreach($schedules as $schedule)
                <tr>
                    @foreach($days as $day)
                        @if($day === $days[$schedule['daysOfWeek'][0]])
                            <td class="time border border-black">
                                <p>{{ $days[$schedule['daysOfWeek'][0]] }}</p>
                                <p>{{ $schedule['title'] }}</p>
                                <p>{{ $schedule['extendedProps']['roomType'] }}</p>
                                <p>{{ $schedule['extendedProps']['roomNumber'] }}</p>
                                <p>{{ $schedule['startTime'] . ' - ' . $schedule['endTime'] }}</p>
                                <p>{{ $schedule['extendedProps']['teacherName'] }}</p>
                            </td>
                        @else
                            <td class="time border border-black">
                                <p></p>
                                <p></p>
                                <p></p>
                                <p></p>
                                <p></p>
                                <p></p>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</main>