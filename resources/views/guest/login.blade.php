<x-layout>
    <x-slot:title>
        Guest Login Page
    </x-slot>
    <x-slot:header>
        <x-header>
        </x-header>
    </x-slot:header>
    <div class="flex flex-col flex-wrap flex-1  min-h-[70vh] items-left justify-center sm:items-center ">
        <h3 class="bg-[#254067] p-1 text-white font-semibold w-full text-lg">Enter Your address to Proceed</h3>

        @if (session('status'))
            <p class="text-xl text-red-600">{{ session('status') }}</p>
        @endif


        <form action="{{ route('guest.address.register') }}"
            class="mt-3 bg-gray-10 flex flex-col gap-2 min-w-full sm:max-w-lg" method="POST">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="name" class="text-[#254067] font-semibold">Your Name</label>
                <input type="name" name="name" id="name"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6"
                    placeholder="e.g: John Doe">
                @error('name')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-row gap-1 
             items-center">
                <label for="building_unit" class="text-[#254067] font-semibold ">Building Unit</label>
                <select name="building_unit" id="building_unit"
                    class="text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6 p-1 rounded-sm">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
                @error('building_unit')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="apartment_number" class="text-[#254067] font-semibold">Apartment Number</label>
                <input type="apartment_number" name="apartment_number" id="apartment_number"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6"
                    placeholder="e.g: 050">
                @error('apartment_number')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="room_number" class="text-[#254067] font-semibold">Room Number</label>
                <input type="room_number" name="room_number" id="room_number"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6"
                    placeholder="e.g: 03">
                @error('room_number')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex gap-2">
                <input type="submit" value="Proceed"
                    class="p-2 px-3 text-[#0b62db] bg-gray-200 w-fit font-semibold cursor-pointer">
                <a class="cursor-pointer p-2 bg-[#254067] text-white rounded-sm w-fit text-left sm:text-center mt-2"
                    href="{{ route('login.page') }}">Login Instead</a>
            </div>
        </form>
    </div>
</x-layout>
