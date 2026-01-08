<x-layout>
    <x-slot:title>
        Admin Dashboard Page
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
    <div class="p-1 flex flex-row flex-wrap gap-1 justify-center items-center">
        <div class="border-2 border-[#5e66f5]  p-2 sm:min-w-50 flex flex-col gap-0.5 rounded-md">
            <h3 class="font-semibold text-[#5e66f5] uppercase text-sm">Total Bookings</h3>
            <h4 class="font-bold text-2xl text-[#5e66f5]">{{ $booking_stats }}</h4>
        </div>
        <div class="border-2 border-[#5e66f5]  p-2 min-w-50 flex flex-col gap-0.5 rounded-md">
            <h3 class="font-semibold text-[#5e66f5] uppercase text-sm">Total Users</h3>
            <h4 class="font-bold text-2xl text-[#5e66f5]">{{ $users_stats }}</h4>
        </div>
    </div>
    <div>
        <div class="flex gap-2 justify-center items-center mb-2">
            <a href="?tab=members"
                class="text-lg {{ request('tab') === 'members' ? 'text-[#0466f9] font-bold border-b-2' : '' }}">Members</a>
            <a href="?tab=bookings"
                class="text-lg {{ request('tab', 'bookings') == 'bookings' ? 'text-[#0466f9] font-bold border-b-2' : '' }}">Bookings
            </a>
        </div>
        {{-- //Displaying Bookings here --}}
        @if ($tab == 'bookings')
            @if (!empty($bookings))
                <table class="w-full border-2 border-gray-500">
                    <thead class="w-full">
                        <tr class="flex gap-2 justify-between w-full border-b flex-row">
                            <th class="font-bold p-1 text-center text-lg">S.N.</th>
                            <th class="font-bold p-1  text-center text-lg">Time</th>
                            <th class="font-bold p-1  text-center text-lg">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="flex gap-2 w-full border-b justify-between">
                                <td class="p-2">{{ $booking->id }}</td>
                                <td class="p-2">
                                    {{ date_create($booking->booking_date)->format('d.m.Y') }}-{{ substr($booking->timeslot->start_time, 0, 2) }}
                                </td>
                                <td class="p-2 cursor-pointer"><button
                                        class="openModalButton  bg-[#0b62db] w-full h-full rounded-sm text-white p-0.5 px-1 cursor-pointer"
                                        data-booking='@json($booking, JSON_HEX_APOS | JSON_HEX_QUOT)' data-type='booking'>
                                        More</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $bookings->appends(request()->all())->links('pagination::tailwind') }}
            @else
                <h2>No Bookings Found</h2>
            @endif
        @else
            @if (!empty($users))
                <div class="my-2 flex flex-row gap-2 justify-center items-center">
                    <form action="{{ route('admin.user.dashboard') }}" method="GET">
                        @foreach (request()->except('search') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <label for="searchBy">Sort By</label>
                        <select name="search" id="searchBy"
                            class="text-[#0b62db] bg-[#0b62db1e] outline-1 -outline-offset-1 outline-gray-300 placeholder:text-[#0b62db] focus:outline-2 focus:-outline-offset-2 focus:outline-[#254067] sm:text-sm/6">
                            <option value="all" {{ request('search') === 'all' ? 'selected' : '' }}>All</option>
                            <option value="admin" {{ request('search') === 'admin' ? 'selected' : '' }}>Admin members
                            </option>
                            <option value="member" {{ request('search') === 'member' ? 'selected' : '' }}>Normal
                                members
                            </option>
                        </select>
                        <input type="submit" value="Get"
                            class="bg-[#0b62db] text-white  rounded-sm text-center hover:bg-[#6f9ee0] cursor-pointer px-1.5 py-1">
                    </form>
                    <a href="{{ route('admin.user.dashboard', ['tab' => 'members']) }}"
                        class="bg-[#1059c0] text-white rounded-sm px-1.5 py-1">
                        Reset
                    </a>
                </div>



                <table class="w-full border-2 border-gray-500">
                    <thead class="w-full">
                        <tr class="flex gap-2 justify-between w-full border-b flex-row">
                            <th class="font-bold p-1  text-center text-lg">S.N.</th>
                            <th class="font-bold p-1  text-center text-lg">Email</th>
                            <th class="font-bold p-1  text-center text-lg">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="flex gap-2 w-full border-b justify-between">
                                <td class="p-2">{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="p-2"><button
                                        class="openModalButton  bg-[#0b62db] w-full h-full rounded-sm text-white p-0.5 px-1 cursor-pointer"
                                        data-user='@json($user, JSON_HEX_APOS | JSON_HEX_QUOT)' data-type='user'>
                                        More</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->appends(request()->all())->links() }}
            @else
                <h2>No Users Found</h2>
            @endif

        @endif
    </div>

    {{-- Modal for Viewing each User's Booking Information, User information --}}
    <div id="GenericModal" class="hidden fixed inset-0 z-50 grid place-content-center bg-black/50 p-4 backdrop-blur-sm "
        role="dialog" aria-modal="true">
        <div id="GenericModalContent" class="w-full max-w-md rounded-lg  bg-white p-6 shadow-lg">
            <div class="flex justify-between items-center ">
                <h2 id="GenericModalTitle" class="text-xl font-bold text-gray-900 sm:text-xl "></h2>
                <button onclick="closeAdminModal()"
                    class="w-8 h-8 text-gray-500 hover:text-gray-900 text-4xl cursor-pointer flex justify-between items-center  leading-none">&times;</button>
            </div>
            <div id="GenericModalBody" class="mt-4 text-gray-600">
            </div>
            <footer class="mt-6 flex justify-end gap-2">
                <button type="button" onclick="closeAdminModal()"
                    class="rounded bg-[#0263ea] px-4 py-2 text-sm font-medium text-white hover:bg-[#4086e89e] cursor-pointer">
                    Close
                </button>
            </footer>
        </div>
    </div>

    {{-- Modal ends here --}}

    <script>
        let AdminModal = document.getElementById('GenericModal');
        let modalTitle = document.getElementById('GenericModalTitle');
        let modalBody = document.getElementById('GenericModalBody');
        let GenericModalContent = document.getElementById('GenericModalContent');

        function closeAdminModal() {
            AdminModal.classList.add('hidden');
        }

        document.querySelectorAll('.openModalButton').forEach(button => {
            button.addEventListener('click', () => {
                let type = button.dataset.type;
                if (type === 'booking') {
                    let booking = JSON.parse(button.dataset.booking);
                    console.log(booking);
                    modalTitle.textContent = `Booking #${booking.id} Details`;
                    let date = new Date(booking.booking_date);
                    let formattedDate = date.getDate() + '.' + date.getMonth() + 1 + '.' + date
                        .getFullYear();
                    modalBody.innerHTML = `
                <p><strong>Date:</strong> ${formattedDate}</p>
                <p><strong>Time:</strong> ${booking.timeslot.start_time.substring(0,5)}</p>
                <p><strong>User:</strong> ${booking.user.name}</p>
                <p><strong>Email:</strong> ${booking.user.email}</p>
                <form action="
                    {{ route('admin.slot.cancel') }}" method='POST'>
                    @csrf
                    <input type="hidden" name="booking_id" value="${booking.id}">
            <input type="hidden" name="user_id" value="${booking.user.id}">
            <button type="submit"
                class="mt-2 bg-red-600 text-white px-1 py-0.5 rounded cursor-pointer">
                Cancel Booking
            </button>
                </form>
            `;
                } else if (type === 'user') {
                    let user = JSON.parse(button.dataset.user);
                    let adminPromoteForm = `  <form action="
                    {{ route('admin.promote.member') }}" method='POST'>
                    @csrf
                    <input type="hidden" name="user_id" value="${user.id}">
            <button type="submit"
                class=" bg-red-600 text-white px-1 py-1 rounded cursor-pointer text-sm">
                Promote to Administrator
            </button>
                </form>`;
                    let adminRemoveForm = `<form action="
                    {{ route('admin.remove.member') }}" method='POST'>
                    @csrf
                    <input type="hidden" name="user_id" value="${user.id}">
            <button type="submit"
                class=" bg-red-600 text-white px-1 py-0.5 rounded cursor-pointer text-sm">
                Remove from Administrator
            </button>
                </form>`;
                    modalTitle.textContent = `User #${user.id} Details`;
                    modalBody.innerHTML = `
                <p><strong>Name:</strong> ${user.name}</p>
                <p><strong>Email:</strong> ${user.email}</p>
                <p><strong>Address:</strong> ${user.address}</p>
                <p><strong>Role:</strong> ${user.isAdmin ? 'Administrator':'Member'}</p>
                <div class="flex gap-1 flex-wrap">
            ${user.isAdmin ? adminRemoveForm:adminPromoteForm}
            <form action="
                    {{ route('admin.delete.member') }}" method='POST'>
                    @csrf
                    <input type="hidden" name="user_id" value="${user.id}">
            <button type="submit"
                class=" bg-red-600 text-white px-1 py-1 rounded cursor-pointer text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>
            </button>
                </form>
                </div>
            `;
                }
                AdminModal.classList.remove('hidden');
            });
        });

        document.addEventListener('click', function(event) {
            if (!GenericModalContent.contains(event.target) && !event.target.closest('.openModalButton')) {
                closeAdminModal();
            }
        });
    </script>
</x-layout>
