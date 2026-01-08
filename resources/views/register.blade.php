<x-layout>
    <x-slot:title>
        Register Page
    </x-slot>
    <x-slot:header>
        <x-header>
        </x-header>
    </x-slot:header>
    <div class="flex flex-col flex-wrap flex-1 min-h-[90vh] h-[90vh] items-center justify-center">
        <h3 class="bg-[#254067] p-1 text-white font-semibold w-full text-lg">REGISTER YOUR ACCOUNT</h3>

        @if (session('status'))
            <p class="text-xl text-red-600">{{ session('status') }}</p>
        @endif


        <form action="{{ route('user.register') }}" class="mt-3 bg-gray-10 flex flex-col gap-2 min-w-full sm:max-w-lg"
            method="POST">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="email" class="text-[#0b62db] font-semibold ">EMAIL</label>
                <input type="email" name="email" id="email"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6"
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
                @if (session('account'))
                    <p>
                        {{ session('account') }}
                    </p>
                @endif
            </div>
            <div class="flex flex-col gap-1">
                <label for="name" class="text-[#0b62db] font-semibold ">NAME</label>
                <input type="text" name="name" id="name"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6""
                    value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="address" class="text-[#0b62db] font-semibold ">ADDRESS</label>
                <input type="text" name="address" id="address"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6""
                    value="{{ old('address') }}" required>
                @error('address')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="contact_no" class="text-[#0b62db] font-semibold ">contact[Optional]</label>
                <input type="text" name="contact_no" id="contact_no"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6""
                    value="{{ old('contact_no') }}">
                @error('contact_no')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="password" class="text-[#0b62db] font-semibold">PASSWORD</label>
                <input type="password" name="password" id="password"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6"
                    required>
                @error('password')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="password_confirmation" class="text-[#0b62db] font-semibold">CONFIRM PASSWORD</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6""
                    required>
                @error('password_confirmation')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <input type="submit" value="REGISTER"
                class="p-2 px-3 text-[#0b62db] bg-gray-200 w-fit font-semibold cursor-pointer">
        </form>
        <div class="w-full mt-2 ">
            <a href="{{ route('login.page') }}"
                class="text-[#0b62db] w-fit font-semibold cursor-pointer text-left">Have
                account, Log in</a>
        </div>
    </div>

</x-layout>
