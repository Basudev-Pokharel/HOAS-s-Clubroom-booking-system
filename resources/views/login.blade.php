<x-layout>
    <x-slot:title>
        Login Page
    </x-slot>
    <x-slot:header>
        <x-header>
        </x-header>
    </x-slot:header>
    <div class="flex flex-col flex-wrap flex-1  min-h-[70vh] items-center justify-center">
        <h3 class="bg-[#5e66f5] p-1 text-white font-semibold w-full text-lg">Log In</h3>
        <form action="" class="mt-3 bg-gray-10 flex flex-col gap-2 min-w-full sm:max-w-lg">
            <div class="flex flex-col gap-1">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="p-1.5 text-[#5e66f5] bg-gray-200 focus">
            </div>
            <div class="flex flex-col gap-1">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="p-1.5 text-[#5e66f5] bg-gray-200">
            </div>
            <input type="submit" value="LOGIN" class="p-2 px-3 text-[#5e66f5] bg-gray-200 w-fit font-semibold ">
        </form>
    </div>

</x-layout>
