<x-layout>
    <x-slot:title>
        Login Page
    </x-slot>
    <x-slot:header>
        <x-header>
        </x-header>
    </x-slot:header>
    <div class="flex flex-col flex-wrap flex-1  min-h-[70vh] items-left justify-center sm:items-center">
        <h3 class="bg-[#254067] p-1 text-white font-semibold w-full text-lg">LOG IN</h3>

        @if (session('status'))
            <p class="text-xl text-red-600">{{ session('status') }}</p>
        @endif


        <form action="{{ route('user.login') }}" class="mt-3 bg-gray-10 flex flex-col gap-2 min-w-full sm:max-w-lg"
            method="POST">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="email" class="text-[#254067] font-semibold ">EMAIL</label>
                <input type="text" name="email" id="email"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6">
                @error('email')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="password" class="text-[#254067] font-semibold">PASSWORD</label>
                <input type="password" name="password" id="password"
                    class="p-1.5 text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6">
                @error('password')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex gap-1">
                <input type="checkbox" name="remember" id="remember"
                    class="p-1.5 text-[#0b62db] bg-gray-200 border-none">
                <label for="remember" class="text-[#0b62db] font-semibold">Remember me</label>
            </div>
            <div class="flex gap-2">
                <input type="submit" value="LOGIN"
                    class="p-2 px-3 text-[#0b62db] bg-gray-200 w-fit font-semibold cursor-pointer">
                <a class="cursor-pointer p-1 bg-[#254067] text-white rounded-sm w-fit text-left sm:text-center mt-2"
                    href="{{ route('validate.page') }}">Address Way</a>
            </div>
        </form>
        <div class="w-full mt-2 ">
            <a href="{{ route('user.register') }}"
                class="text-[#0b62db] w-fit font-semibold cursor-pointer text-left">Donot
                have
                account, Make one</a>
        </div>
        <a class="cursor-pointer p-2 bg-[#254067] text-white rounded-sm w-fit text-left sm:text-center mt-2"
            href="{{ route('admin.login.page') }}">Manager
            Login</a>

    </div>

</x-layout>
