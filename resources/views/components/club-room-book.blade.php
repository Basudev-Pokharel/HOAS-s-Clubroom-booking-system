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
    </style>
    {{-- <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh --> --}}
    <h4 class="text-xl font-bold  text-[#5e66f5] mt-2.5">
        MAKING A RESERVATION FOR CLUB ROOM
    </h4>
    <ul class="list-['-'] text-xs w-full px-5 text-wrap">
        <li>Turns are reserved first come first served basis. </li>
        <li>The next month is reservable starting at 00.00 on the first day of the previous month.</li>
        <li>Reservation can be cancelled without any time limit, but cancellations made less than 12 hours before the
            reserved time will be counted to the total amount of reservations</li>
    </ul>
    <div class="mt-3 flex gap-4 flex-wrap justify-center w-full">
        <h4 class=" w-full bg-gray-50 border-b border-gray-300 text-center font-semibold text-[#5e66f5] p-1">CLUBROOM,
            STAIRCASE C</h4>

        <h4
            class="w-full bg-gray-50 border-b border-gray-300 text-center font-semibold text-[#5e66f5] p-1 border flex items-center justify-center">
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
            <label for="date"
                id='date_label'>{{ $selectedDay . ' ' }}{{ date_format(date_create($selectedDate), 'd.m.Y') }}</label>
            <input type="date" name="date" id="date" min="{{ $printable_date_today }}"
                max="{{ $printable_date_after_2_month }}" value="{{ $selectedDate }}" class='date-only-icon'
                onchange="window.location='?date=' + this.value">
        </h4>
        <div>
            <h4 class="w-full bg-gray-100  text-center font-semibold text-gray-600 p-1">CLUB ROOM
            </h4>
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
            <h4 class="w-full bg-gray-200  text-center font-semibold text-gray-600 p-1">RESERVATIONS USED THIS MONTH:
                {{ $slots_booked }}
                out
                of 10
            </h4>
            <div class="w-full bg-gray-100  text-center text-gray-600 border-2 flex justify-center items-center">
                <table class="w-full overflow-x-auto">
                    <tbody>

                        @foreach ($relevant_slots as $slot)
                            <tr class=" flex gap-2 {{ $slot->id % 2 == 0 ? 'bg-gray-200' : '' }}">
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

    <h1>Is logged in:{{ Auth::check() ? 'true' : 'false' }}</h1>
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
