<title>{{ $sectionname }}</title>

<x-layout>
    <main class="w-full flex flex-col h-fit gap-8 px-20 py-10">
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() }}">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.44067 14.9406C4.85474 15.5266 4.85474 16.4781 5.44067 17.0641L12.9407 24.5641C13.5266 25.15 14.4782 25.15 15.0641 24.5641C15.65 23.9781 15.65 23.0266 15.0641 22.4406L10.1188 17.5H24.5C25.3297 17.5 26 16.8297 26 16C26 15.1703 25.3297 14.5 24.5 14.5H10.1235L15.0594 9.55937C15.6454 8.97344 15.6454 8.02187 15.0594 7.43594C14.4735 6.85 13.5219 6.85 12.936 7.43594L5.43599 14.9359L5.44067 14.9406Z" fill="black"/>
                </svg>
            </a>
            <h1>{{ $sectionname }}</h1>
        </div>
        <div id="calendar" class="h-full"></div>
        @push('scripts')

            <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
            <script>

                document.addEventListener('DOMContentLoaded', function() {
                  var calendarEl = document.getElementById('calendar');
                  var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    headerToolbar: false,
                    allDaySlot: false,
                    slotMinTime: "6:00:00",
                    slotMaxTime: "21:00:00",
                    hiddenDays: [0],
                    dayHeaderFormat: { weekday: 'long' },
                    events: '/fetchtimeslots/{{ $id }}',
                    eventDidMount: function (info) {
                        let eventEl = info.el;

                        let details = document.createElement("div");
                        details.classList.add("fc-event-extended-props")
                        
                        let teacherName = info.event.extendedProps.teacherName;
                        let roomNumber = info.event.extendedProps.roomNumber;
                        let roomType = info.event.extendedProps.roomType;

                        details.innerHTML = `
                            <small>${teacherName}</small>
                            <small>${roomNumber}</small>
                            <small>${roomType.toUpperCase()}</small>
                        `;

                        eventFieldParentEl = eventEl.querySelector(".fc-event-main-frame");

                        eventFieldParentEl.appendChild(details);
                    },
                  });
                  calendar.render();
                });
                
              </script>
        @endpush
    </main>
</x-layout>