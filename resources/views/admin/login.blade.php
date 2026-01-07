<x-layout>
    <x-slot:title>
        Admin|Login Page
    </x-slot>
    <x-slot:header>
        <x-header>
        </x-header>
    </x-slot:header>
    <div class="flex flex-col flex-wrap flex-1  min-h-[70vh] items-center justify-center">
        <h3 class="bg-[#254067] p-1 text-white font-semibold w-full text-lg">LOG IN ADMINISTRATOR</h3>

        @if (session('status'))
            <p class="text-xl text-red-600">{{ session('status') }}</p>
        @endif


        <form action="{{ route('admin.login') }}" class="mt-3 bg-gray-10 flex flex-col gap-2 min-w-full sm:max-w-lg"
            method="POST">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="email" class="text-[#254067] font-semibold ">EMAIL</label>
                <input type="text" name="email" id="email" class="p-1.5 text-[#5e66f5] bg-gray-200 focus">
                @error('email')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="password" class="text-[#254067] font-semibold">PASSWORD</label>
                <input type="password" name="password" id="password" class="p-1.5 text-[#5e66f5] bg-gray-200">
                @error('password')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <input type="submit" value="LOGIN"
                class="p-2 px-3 text-[#5e66f5] bg-gray-200 w-fit font-semibold cursor-pointer">
        </form>
    </div>
    <a class="cursor-pointer p-2 bg-[#254067] text-white rounded-sm" href="{{ route('user.login') }}">Member Login</a>
</x-layout>
