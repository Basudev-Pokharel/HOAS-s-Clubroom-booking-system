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

    {{-- <div class="alert alert-success">
        world is best for living beings
    </div> --}}


    {{-- Div for padding so that everything don't flow out --}}
    <div class="p-1 flex flex-col flex-wrap gap-1 justify-center items-center">
        <h1 class="text-3xl font-bold  text-[#5e66f5] mt-2.5">
            ASIAKKAANKATU 6*
        </h1>
        <p class="mt-2"><span class="text-red-500 font-bold">*</span> This website is created for the proper
            bookings
            system for
            the clubrooms in this
            building so it is open for everyone</p>
        <div class="border-2 p-3 rounded-sm border-gray-400 flex justify-center items-center gap-1 text-[#5e66f5]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6" style="color:#5e66f5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Clubroom
        </div>

        {{-- For booking summary part --}}
        <div class="w-full">
            <h3 class="bg-[#5e66f5] p-1 text-white font-semibold w-full text-lg">Booking Summary</h3>
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
                                stroke-width="1.5" stroke="currentColor" class="size-6" style="color:#5e66f5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <p>
                                {{-- {{ $booking->timeslot()->start_time }} Clubroom --}}
                                {{ date_create($booking->booking_date)->format('D') }}
                                {{ date_create($booking->booking_date)->format('d.m.Y') }} at
                                {{ substr($booking->timeslot->start_time, 0, 5) }} -
                                {{ substr($booking->timeslot->end_time, 0, 5) }}
                                Clubroom
                                {{-- {{ $booking->booking_date }} Clubroom --}}
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
        <x-club-room-book></x-club-room-book>
    </div>
</x-layout>
