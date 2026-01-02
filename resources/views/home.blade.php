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
        <div class="alert alert-success">
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
            <div class="flex justify-start items-center flex-row flex-wrap">
                {{-- Parent container --}}
                <div class="flex justify-baseline items-center gap-1 flex-wrap  w-full bg-amber-100 p-1">
                    {{-- Child container --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6" style="color:#5e66f5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <p>Tue 23.12.2025 18:00 - 19:00 Clubroom</p>
                </div>
                <div class="flex justify-baseline items-center gap-1 flex-wrap  w-full bg-amber-50 p-1">
                    {{-- Second Child container --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6" style="color:#5e66f5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <p>Tue 23.12.2025 18:00 - 19:00 Clubroom</p>
                </div>
            </div>
        </div>
        <x-club-room-book></x-club-room-book>
    </div>
</x-layout>
