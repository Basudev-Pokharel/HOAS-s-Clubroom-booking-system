<x-layout>
    <x-slot:title>
        Booking Page
    </x-slot>

    <x-slot:header>
        <x-header>
        </x-header>
    </x-slot:header>

    {{-- Alert message for not loggint here --}}
    @if (session('status'))
        <div class="text-center text-green-600">
            {{ session('status') }}
        </div>
    @endif


    {{-- Div for padding so that everything don't flow out --}}
    <div class="p-1 flex flex-col flex-wrap gap-1 justify-center items-center">
        <h1 class="text-3xl font-bold  text-[#0b62db] mt-2.5 flex justify-center items-center">
            ASIAKKAANKATU 6* <div
                class="border-2 p-3 rounded-sm border-gray-400 flex justify-center items-center gap-1 text-[#0b62db]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6" style="color:#5e66f5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </div>
        </h1>
        <p class="mt-2"><span class="text-red-500 font-bold">*</span> This website is created for the proper
            bookings
            system for
            the clubrooms in this
            building so it is open for everyone</p>
        <x-key-info></x-key-info>

        <div class="border w-full sm:max-w-[500px] mb-4 mt-3">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="bg-[#254067] w-full text-white p-1 font-extrabold">
                            Booking Time Availability
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="bg-[#0b62db1e] w-full text-black p-1 px-2">
                            Sun-Thu-- 08:00-10:00
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-[#4c5663ba] w-full text-white p-1 px-2">
                            Fri-Sat-- 08:00-11:00
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>




        {{-- For booking summary part --}}
        <div class="w-full">
            <h3 class="bg-[#254067] p-1 text-white font-semibold w-full text-lg">Booking Summary</h3>
            {{-- //Loops for the booked shows goes here --}}
            @php
                $booked_slots = \App\Models\Booking::with('timeslot')
                    ->where('user_id', auth()->id())
                    ->whereDate('booking_date', '>=', now())
                    ->orderBy('booking_date', 'asc')
                    ->get();
            @endphp
            @if (count($booked_slots) > 0)
                @foreach ($booked_slots as $booking)
                    <div class="flex justify-start items-center flex-row flex-wrap">
                        {{-- Parent container --}}
                        <div
                            class="flex justify-baseline items-center gap-1 flex-wrap  w-full {{ $loop->index % 2 == 0 ? 'bg-gray-200' : '' }}
                            p-1">
                            {{-- Child container --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6" style="color:#254067">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />


                            </svg>
                            <p>
                                {{ date_create($booking->booking_date)->format('D') }}
                                {{ date_create($booking->booking_date)->format('d.m.Y') }} at
                                {{ substr($booking->timeslot->start_time, 0, 5) }} -
                                {{ substr($booking->timeslot->end_time, 0, 5) }}
                                Clubroom
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="flex justify-start items-center flex-row flex-wrap">
                    {{-- Parent container --}}
                    <div class="flex justify-baseline items-center gap-1 flex-wrap  w-full bg-gray-200' p-1">
                        {{-- Child container --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6" style="color:#5e66f5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <p>No Bookings found</p>
                    </div>
                </div>

            @endif
        </div>
        {{-- For list of Admins or who have Key --}}
        <div>

        </div>
        <x-club-room-book></x-club-room-book>
    </div>
</x-layout>
