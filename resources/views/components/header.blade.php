<header class="bg-[#5e66f5] text-white p-2 flex justify-between items-center">
    {{-- <img src={{ public_path() . '\images\logo.png' }}> --}}
    <img src="/images/logo.png" alt="cannot load" class="w-[200px] cursor-pointer"
        onclick="location.href='{{ route('dashboard') }}'">
    @auth
        <div class="border-2 border-amber-300 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6"
                class="text-[#5e66f5]" onclick="ModalOpen()" id='userIcon'>
                <path fill-rule="evenodd"
                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                    clip-rule="evenodd" />
            </svg>
        </div>

        {{-- //Modal for the User information here --}}
        <div class="hidden fixed inset-0 z-50 grid place-content-center bg-black/50 p-4" role="dialog" aria-modal="true"
            aria-labelledby="modalTitle" id='UserModal'>
            <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg" id='insideModal'>
                <div id="modalTitle" class="flex justify-between">
                    <h2 class="text-xl font-bold text-gray-900 sm:text-2xl">User Profile </h2>
                    <form action="{{ route('user.logout') }}
                    " class="text-gray-950" method="POST">
                        @csrf
                        <button
                            class="flex items-center gap-0.5 rounded bg-blue-600 px-0.5 py-1 text-sm font-medium text-white  hover:bg-blue-700 hover:gap-1.5 transition-all cursor-pointer"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6" class="text-[#5e66f5]">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            LogOut</button>
                    </form>
                </div>
                <div class="mt-4">
                    @session('passwordMismatch')
                        <p class="text-red-500">{{ session('passwordMismatch') }}</p>
                    @endsession
                    <div class="text-gray-600">
                        <p><strong>USERNAME</strong> {{ Auth::user()->name }}</p>
                    </div>
                    <div class="text-gray-600">
                        <p><strong>EMAIL</strong> {{ Auth::user()->email }}</p>
                    </div>
                    <div class="text-gray-600">
                        <p><strong>LOCATION</strong> {{ Auth::user()->address }}</p>
                    </div>
                    <form id='UpdateForm' action="{{ route('user.update') }}"
                        class="mt-1 bg-gray-10 flex flex-col gap-1 min-w-full sm:max-w-lg" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col gap-0.5">
                            <label for="old_password" class="text-[#5e66f5] font-semibold text-sm">OLD PASSWORD</label>
                            <input type="password" name="old_password" id="old_password"
                                class="p-1.5 text-[#5e66f5] bg-gray-200 focus">
                            @error('old_password')
                                <p class="text-xs text-gray-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-0.5">
                            <label for="new_password" class="text-[#5e66f5] font-semibold text-sm">NEW PASSWORD</label>
                            <input type="password" name="newpassword" id="new_password"
                                class="p-1.5 text-[#5e66f5] bg-gray-200">
                            @error('newpassword')
                                <p class="text-xs text-gray-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-0.5">
                            <label for="new_password_confirm" class="text-[#5e66f5] font-semibold text-sm">CONFIRM NEW
                                PASSWORD</label>
                            <input type="password" name="newpassword_confirmation" id="new_password_confirm"
                                class="p-1.5 text-[#5e66f5] bg-gray-200">
                        </div>
                    </form>
                </div>

                <footer class="mt-6 flex justify-end gap-2">
                    <button type="button"
                        class="rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 cursor-pointer"
                        onclick="closeModal()">
                        Cancel
                    </button>

                    <button type="submit" form='UpdateForm'
                        class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700 cursor-pointer">
                        Update
                    </button>
                </footer>
            </div>
        </div>

        <script>
            let modal = document.getElementById('UserModal');
            let insideModal = document.getElementById('insideModal')
            let userIcon = document.getElementById('userIcon');

            function ModalOpen() {
                modal.style.display = 'grid'
            }

            function closeModal() {
                modal.style.display = 'none';
            }
            document.addEventListener('click', function(event) {
                if (!insideModal.contains(event.target) && !userIcon.contains(event.target)) {
                    closeModal();
                }
            });
        </script>
    @endauth
</header>
