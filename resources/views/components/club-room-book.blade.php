<div class="mt-2">
    <style>
        .date-only-icon {
            color: transparent;
            background-color: transparent;
            cursor: pointer;

        }

        .date-only-icon::-webkit-datetime-edit {
            display: none;
        }

        .date-only-icon::-webkit-calendar-picker-indicator {
            cursor: pointer;
        }

        /* //FOr datepicker */
        input[type="date"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        /* Container with relative positioning */
        .datepicker-container {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        /* For mobile viewport */
        @media (max-width: 640px) {
            .datepicker-container {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    {{-- <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh --> --}}
    <h4 class="text-xl font-bold  text-[#0b62db] mt-2.5 text-center">
        BOOKING A CLUB ROOM
    </h4>
    <div class="mt-3 flex gap-4 flex-wrap justify-center w-full">
        <div
            class="flex gap-2 items-center justify-center w-full bg-gray-50 border-b border-gray-300 text-center font-semibold text-[#0b62db] p-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <h4>

                CLUBROOM,
                STAIRCASE C
            </h4>
        </div>

        <div
            class="w-full bg-gray-50 border-b border-gray-300 text-center font-semibold text-[#0b62db] p-1 border flex items-center justify-center gap-2">
            @php
                date_default_timezone_set('EET');
                $date_today = date_create('now');
                $day_today = $date_today->format('l');
                $hour_now = $date_today->format('H');
                $printable_date_today = $date_today->format('Y-m-d');
                $date_after_2_months = date_add($date_today, date_interval_create_from_date_string('2 months'));
                $printable_date_after_2_month = date_format($date_after_2_months, 'Y-m-d');

                //Get date from Url| selected date
                $datee_url = date_create(request('date'));
                $printable_datee_url = $datee_url->format('Y-m-d');
                // echo $printable_datee_url . '|';
                $selectedDate = $printable_datee_url ?? $printable_date_today;
                $selectedDay = $datee_url->format('l');
            @endphp
            <div class="flex items-center justify-center relative overflow-visible ">
                {{-- <div class="datepicker-wrapper"> --}}
                <label for="date" id='date_label' class="text-[#0b62db] flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                    {{ $selectedDay . ' ' }}{{ date_format(date_create($selectedDate), 'd.m.Y') }}</label>

                <input type="date" name="date" id="date" min="{{ $printable_date_today }}"
                    max="{{ $printable_date_after_2_month }}" value="{{ $selectedDate }}"
                    class='date-only-icon relative z-50 mr-8' onchange="window.location='?date=' + this.value">

            </div>
        </div>
        {{-- Datepicker --}}
        {{-- Datepicker ends here --}}



        <div>
            @php
                $slots_booked = \App\Models\Booking::where('user_id', auth()->id())
                    ->whereMonth('booking_date', date_create($selectedDate)->format('m'))
                    ->whereYear('booking_date', now()->year)
                    ->count();
                $slots_available = 10 - $slots_booked;

                if (now()->format('Y-m-d') == $selectedDate) {
                    $relevant_slots = \App\Models\TimeSlot::with([
                        'bookings' => function ($query) use ($selectedDate) {
                            $query->whereDate('booking_date', $selectedDate);
                        },
                    ])
                        ->whereTime('start_time', '>=', now()->format('H:00'))
                        ->get();
                } else {
                    $relevant_slots = \App\Models\TimeSlot::with([
                        'bookings' => function ($query) use ($selectedDate) {
                            $query->whereDate('booking_date', $selectedDate);
                        },
                    ])->get();
                }

            @endphp
            <h4 class="w-full text-[#0b62db] bg-[#0b62db1e]  text-center font-semibold p-1">RESERVATIONS USED THIS
                MONTH:
                {{ $slots_booked }}
                out
                of 10
            </h4>
            <div
                class="w-full bg-gray-100  text-center text-gray-600 border-2 border-[#0b62db] flex justify-center items-center">
                <table class="w-full overflow-x-auto">
                    <tbody>

                        @foreach ($relevant_slots as $slot)
                            <tr class=" flex gap-2 {{ $loop->index % 2 == 0 ? 'text-[#2b65b6] bg-[#0b62db1e]' : '' }}">
                                <td class="border-r-3 p-1 min-w-[100px]">
                                    {{ date_create($slot->start_time)->format('H:00') }}</td>
                                <th class=" p-1 min-w-[100px]">
                                    @if (empty($slot->bookings) || count($slot->bookings) == 0)
                                        <form action="{{ route('slot.book', $slot->id) }}" class="bookingTimeForm"
                                            data-slot-id="{{ $slot->id }}" method="POST">
                                            @csrf
                                            <input type="hidden" name='booking_date' value="{{ $selectedDate }}">
                                            <div>
                                                <input type="submit" value="Vacant" class="cursor-pointer" />
                                            </div>
                                        </form>
                                    @endif
                                    @if (!empty($slot->bookings) && count($slot->bookings) > 0)
                                        <form action="{{ route('slot.cancel', $slot->id) }}" class="bookingTimeForm"
                                            data-slot-id="{{ $slot->id }}" method="POST">
                                            @csrf
                                            <input type="hidden" name='booking_date' value="{{ $slot->start_time }}">
                                            <div>
                                                <input type="submit" value="Booked"
                                                    class="cursor-pointer text-green-600 " disabled />
                                                @if ($slot->bookings[0]->user_id == auth()->id())
                                                    <input type="submit" value="Cancel"
                                                        class="cursor-pointer text-red-500" />
                                                @endif
                                            </div>
                                        </form>
                                    @endif
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        let d = new Date({{ Illuminate\Support\Js::from($selectedDate) }});
        var FullDateCurrentCalander = d.getFullYear() + '-' + d.getMonth() + 1 + '-' + d.getDate();
        let date_label = document.getElementById('date_label');
        let date = document.getElementById('date');
        date.addEventListener('change', (e) => {
            let day = new Date(e.target.value);
            // console.log(day);
            const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            let dateFrontend = e.target.value.split('-');
            let temp = dateFrontend[2];
            dateFrontend[2] = dateFrontend[0];
            dateFrontend[0] = temp;
            let dateFormattedFinnishStyle = dateFrontend.join('.');
            // If user did clear then it shows today's date
            let nowDateFails = new Date();
            let fallbackDate = nowDateFails.getDate() + '.' +
                (nowDateFails.getMonth() + 1) + '.' + nowDateFails.getFullYear();
            console.log('fallback us', fallbackDate)
            FullDateCurrentCalander = dateFormattedFinnishStyle == '..' ? fallbackDate : dateFormattedFinnishStyle;
            console.log('Inside function, curret date is', FullDateCurrentCalander);
            let selectedDay = days[day.getDay()] == undefined ? days[nowDateFails.getDay()] : days[day.getDay()];
            date_label.innerText = selectedDay + "  " + FullDateCurrentCalander;
        })
        console.log('Current date selected is', FullDateCurrentCalander);
        let bookingDateForm = document.querySelectorAll('.bookingTimeForm').forEach(form => {
            form.addEventListener('submit', (e) => {
                // e.preventDefault();
                let form = e.target;
                let dateField = form.querySelectorAll('input')[1];
                console.log(dateField);
                dateField.value = FullDateCurrentCalander;
                console.log('New datefield is,', dateField)
                let slotId = e.target.dataset.slotId;
                console.log('slotId', slotId);
            })
        });;
    </script>
</div>
