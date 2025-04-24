<title>{{ $sectionname }}</title>

@vite(['resources/css/fc-cstm-styles.css'])

<x-layout>

    <dialog id="eventPopup" class="cstm-fc-event-popup outline-none">
        <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
                <h3 id="event-title" class="eventitleh3">Title</h3>
                <img src="{{ asset('assets/icons/x.svg') }}" class="icons-lg" onclick="eventPopup.close()">
            </div>
            <div class="cstm-fc-popup-field-container flex flex-col gap-2">
                <div class="flex gap-4 w-full">
                    <div class="cstm-fc-popup-field w-full">
                        <p id="event-start" class="eventfieldpar paragraph-2 text-txtclr_black">Start Time</p>                                    
                    </div>
                    <img src="{{ asset('assets/icons/arrow.svg') }}" class="icons-lg">
                    <div class="cstm-fc-popup-field w-full">
                        <p id="event-end" class="eventfieldpar paragraph-2 text-txtclr_black">End Time</p>                                    
                    </div>
                </div>
                <div class="cstm-fc-popup-field">
                    <img src="{{ asset('assets/icons/chevron.svg') }}" class="icons-lg">
                    <p id="event-roomtype" class="eventfieldpar paragraph-2 text-txtclr_black">Room Type</p>                                    
                </div>
                <div class="cstm-fc-popup-field">
                    <img src="{{ asset('assets/icons/cube.svg') }}" class="icons-lg">
                    <p id="event-roomnum" class="eventfieldpar paragraph-2 text-txtclr_black">Room Number</p>
                </div>
                <div class="cstm-fc-popup-field">
                    <img src="{{ asset('assets/icons/person.svg') }}" class="icons-lg">
                    <p id="event-teacher" class="eventfieldpar paragraph-2 text-txtclr_black">Teacher</p>
                </div>
            </div>
        </div>
    </dialog>

    <main id="main-element" class="w-full flex flex-col h-full gap-3 lg:px-5 lg:pt-8">
        <div class="flex items-center gap-4 p-5 pt-8 lg:p-0">
            <a href="{{ url()->previous() }}">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.44067 14.9406C4.85474 15.5266 4.85474 16.4781 5.44067 17.0641L12.9407 24.5641C13.5266 25.15 14.4782 25.15 15.0641 24.5641C15.65 23.9781 15.65 23.0266 15.0641 22.4406L10.1188 17.5H24.5C25.3297 17.5 26 16.8297 26 16C26 15.1703 25.3297 14.5 24.5 14.5H10.1235L15.0594 9.55937C15.6454 8.97344 15.6454 8.02187 15.0594 7.43594C14.4735 6.85 13.5219 6.85 12.936 7.43594L5.43599 14.9359L5.44067 14.9406Z" fill="black"/>
                </svg>
            </a>
            <h1>{{ $sectionname }}</h1>
        </div>
        <div id="calendar" class="h-full lg:pr-0"></div>
        
        @push('scripts')

            <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

            <script>

                document.addEventListener('DOMContentLoaded', function() {
                  var calendarEl = document.getElementById('calendar');
                  var calendar = new FullCalendar.Calendar(calendarEl, {
                    height: "100%",
                    initialView: 'timeGridWeek',
                    headerToolbar: false,
                    allDaySlot: false,
                    slotMinTime: "7:00:00",
                    slotMaxTime: "21:00:00",
                    hiddenDays: [0],
                    dayHeaderFormat: { weekday: 'short' },
                    events: '/fetchtimeslots/{{ $id }}',
                    eventContent: function(info) {
                        let title = info.event.title;
                        let roomType = info.event.extendedProps.roomType;
                        let roomNumber = info.event.extendedProps.roomNumber;
                        let teacherName = info.event.extendedProps.teacherName;

                        return {
                            html: `
                            <div class="cstm-fc-event-container flex flex-col gap-2">
                                <h3 class="cstm-fc-event-title">${title}</h3>
                                <div class="cstm-fc-event-field-container flex flex-col gap-1">
                                    <div class="cstm-fc-event-field flex gap-2">
                                        <svg class="icons" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.03328 4.5375L6.44253 6.129L4.85103 4.5375L3.79053 5.598L6.44253 8.25L9.09378 5.598L8.03328 4.5375ZM0.415527 6C0.415527 9.3135 3.10803 12 6.41553 12C9.72903 12 12.4155 9.3075 12.4155 6C12.4155 2.6865 9.72303 0 6.41553 0C3.10203 0 0.415527 2.6925 0.415527 6ZM1.91553 6C1.91553 3.51975 3.93003 1.5 6.41553 1.5C8.89578 1.5 10.9155 3.5145 10.9155 6C10.9155 8.48025 8.90103 10.5 6.41553 10.5C3.93528 10.5 1.91553 8.4855 1.91553 6Z" fill="white"/>
                                        </svg>
                                        <p class="paragraph-2">${roomType}</p>                                    
                                    </div>
                                    <div class="cstm-fc-event-field flex gap-2">
                                        <svg class="icons" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4175 9.09889C12.4175 9.09889 12.4175 9.05088 12.4175 9.02345V2.97447C12.4173 2.89577 12.3984 2.81823 12.3626 2.74814C12.3121 2.63923 12.2246 2.55176 12.1157 2.50125L6.6291 0.0459914C6.5623 0.0156848 6.48981 0 6.41649 0C6.34318 0 6.27068 0.0156848 6.20389 0.0459914L0.71729 2.50125C0.629052 2.54565 0.554434 2.61306 0.501324 2.69636C0.448207 2.77964 0.418566 2.87573 0.415527 2.97447V9.02345C0.420657 9.12166 0.451149 9.21692 0.504033 9.29984C0.556917 9.38275 0.630396 9.45058 0.71729 9.49667L6.20389 11.9519C6.27027 11.9836 6.3429 12 6.41649 12C6.49008 12 6.56271 11.9836 6.6291 11.9519L12.1157 9.49667C12.1949 9.46039 12.2639 9.40511 12.3166 9.33571C12.3692 9.2663 12.4039 9.18496 12.4175 9.09889ZM1.44427 3.76316L5.90212 5.76578V10.69L1.44427 8.69425V3.76316ZM6.93086 5.76578L11.3887 3.76316V8.69425L6.93086 10.69V5.76578ZM6.43021 1.07473L10.6617 2.97447L6.43021 4.86735L2.19867 2.97447L6.43021 1.07473Z" fill="white"/>
                                        </svg>
                                        <p class="paragraph-2">${roomNumber}</p>
                                    </div>
                                    <div class="cstm-fc-event-field flex gap-2">
                                        <svg class="icons" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.41563 6.71788C8.17386 6.71788 8.90104 6.41667 9.4372 5.88051C9.97335 5.34436 10.2746 4.61718 10.2746 3.85894C10.2746 3.1007 9.97335 2.37352 9.4372 1.83736C8.90104 1.30121 8.17386 1 7.41563 1C6.65739 1 5.93021 1.30121 5.39405 1.83736C4.8579 2.37352 4.55669 3.1007 4.55669 3.85894C4.55669 4.61718 4.8579 5.34436 5.39405 5.88051C5.93021 6.41667 6.65739 6.71788 7.41563 6.71788ZM7.41563 7.97396C3.61448 7.97396 1.17773 10.0716 1.17773 11.0929V13H13.6535V11.0929C13.6535 9.85781 11.3466 7.97396 7.41563 7.97396Z" fill="white"/>
                                        </svg>
                                        <p class="paragraph-2">${teacherName}</p>
                                    </div>
                                </div>
                            </div>`
                        };
                    },
                    eventClick: function(info) {

                        info.jsEvent.stopPropagation();

                        let title = info.event.title;
                        let roomType = info.event.extendedProps.roomType;
                        let roomNumber = info.event.extendedProps.roomNumber;
                        let teacherName = info.event.extendedProps.teacherName;
                        let timeStart = info.event.start;
                        let timeEnd = info.event.end;
                        
                        const eventPopup = document.getElementById('eventPopup');

                        const eventTitle = document.getElementById('event-title');
                        const eventRoomType = document.getElementById('event-roomtype');
                        const eventRoomNumber = document.getElementById('event-roomnum');
                        const eventTeacherName = document.getElementById('event-teacher');
                        const eventStart = document.getElementById('event-start');
                        const eventEnd = document.getElementById('event-end');
                        eventTitle.textContent = title;
                        eventRoomType.textContent = roomType;
                        eventRoomNumber.textContent = roomNumber;
                        eventTeacherName.textContent = teacherName;
                        eventStart.textContent = formatTime(timeStart);
                        eventEnd.textContent = formatTime(timeEnd);
                        
                        eventPopup.showModal();
                        console.log('pop up rendered');
                    }
                  });
                  calendar.render();
                });

                function formatTime(time) {
                    let hours = time.getHours();
                    let minutes = time.getMinutes().toString().padStart(2, '0');
                    let dayPeriod = hours >= 12 ? 'PM' : 'AM';
                    console.log("before ", hours)

                    hours = hours > 12 ? hours - 12 : hours;

                    console.log(hours)

                    return `${hours}:${minutes} ${dayPeriod}`;
                }

              </script>
        @endpush
    </main>
</x-layout>