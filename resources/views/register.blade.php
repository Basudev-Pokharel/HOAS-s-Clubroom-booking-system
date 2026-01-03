<x-layout>
    <x-slot:title>
        Register Page
    </x-slot>
    <x-slot:header>
        <x-header>
        </x-header>
    </x-slot:header>
    <div class="flex flex-col flex-wrap flex-1 min-h-[90vh] h-[90vh] items-center justify-center border-2">
        <h3 class="bg-[#5e66f5] p-1 text-white font-semibold w-full text-lg">REGISTER YOUR ACCOUNT</h3>

        @if (session('status'))
            <p class="text-xl text-red-600">{{ session('status') }}</p>
        @endif


        <form action="{{ route('user.register') }}" class="mt-3 bg-gray-10 flex flex-col gap-2 min-w-full sm:max-w-lg"
            method="POST">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="email" class="text-[#5e66f5] font-semibold ">EMAIL</label>
                <input type="email" name="email" id="email" class="p-1.5 text-[#5e66f5] bg-gray-200 focus"
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
                @session('account')
                    <p>
                        {{ session('account') }}
                    </p>
                @endsession
            </div>
            <div class="flex flex-col gap-1">
                <label for="name" class="text-[#5e66f5] font-semibold ">NAME</label>
                <input type="text" name="name" id="name" class="p-1.5 text-[#5e66f5] bg-gray-200 focus"
                    value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="address" class="text-[#5e66f5] font-semibold ">ADDRESS</label>
                <input type="text" name="address" id="address" class="p-1.5 text-[#5e66f5] bg-gray-200 focus"
                    value="{{ old('address') }}" required>
                @error('address')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="password" class="text-[#5e66f5] font-semibold">PASSWORD</label>
                <input type="password" name="password" id="password" class="p-1.5 text-[#5e66f5] bg-gray-200" required>
                @error('password')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="password_confirmation" class="text-[#5e66f5] font-semibold">CONFIRM PASSWORD</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="p-1.5 text-[#5e66f5] bg-gray-200" required>
                @error('password_confirmation')
                    <p class="text-xs">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <input type="submit" value="REGISTER"
                class="p-2 px-3 text-[#5e66f5] bg-gray-200 w-fit font-semibold cursor-pointer">
        </form>
        <div class="w-full mt-2 ">
            <a href="{{ route('login.page') }}"
                class="text-[#5e66f5] w-fit font-semibold cursor-pointer text-left">Have
                account, Log in</a>
        </div>
    </div>

</x-layout>
