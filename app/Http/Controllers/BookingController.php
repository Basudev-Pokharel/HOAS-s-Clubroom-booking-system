<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function book($timeslot, Request $request)
    {
        $request->validate([
            'booking_date' => 'required',
        ]);
        // return session('user_address')->id;
        $is_booked = Booking::create([
            'user_id' => auth()->id() ?? null,
            'club_room_id' => 1,
            'address_id' => session('user_address')->id ?? null,
            'time_slot_id' => $timeslot,
            'booking_date' => date_create($request->booking_date)->format('Y-m-d')
        ]);
        if ($is_booked) {
            return redirect('/')->with('status', 'Booking successfull');
        } else {
            return back()->with('status', 'Booking Failed, Contact Developers');
        }
    }
    public function cancel($timeslot, Request $request)
    {
        // return $timeslot;
        $request->validate([
            'booking_date' => 'required',
        ]);
        $date = date_create($request->booking_date)->format('Y-m-d');
        $is_delete = Booking::where('user_id', auth()->id())->where('club_room_id', 1)->where('time_slot_id', $timeslot)->where('booking_date', $date)->delete();
        if ($is_delete) {
            return redirect('/')->with('status', 'Deletion successfull');
        } else {
            return back()->with('status', 'Delete Failed, Contact Developers');
        }
    }
    public function cancelByAdmin(Request $request)
    {
        // return $timeslot;
        $request->validate([
            'booking_id' => 'required',
            'user_id' => 'required',
        ]);
        $booking_id = $request->booking_id;
        $user_id = $request->user_id;
        $is_delete = Booking::where('id', $booking_id)->where('user_id', $user_id)->delete();
        if ($is_delete) {
            return back()->with('status', 'Deletion Successfull');
        } else {
            return back()->with('status', 'Delete Failed, Contact Developers');
        }
    }
    public function viewBookingsAdmin(Request $request)
    {
        $tab = $request->get('tab', 'bookings');
        $bookings = collect();
        $users = collect();

        //Stats to show in the dashboard
        $booking_stats = Booking::whereDate('booking_date', '>=', now())->count();
        $users_stats = User::count();


        if ($tab === 'bookings') {
            $bookings = Booking::with(['user', 'timeslot'])->paginate(10);
        } else {
            $search = $request->get('search', 'all');

            $usersQuery = User::query();

            if ($search === 'admin') {
                $usersQuery->where('isAdmin', 1);
            }

            if ($search === 'member') {
                $usersQuery->where('isAdmin', 0);
            }

            $users = $usersQuery
                ->paginate(10)
                ->withQueryString();
        }
        return view('admin.home', compact('tab', 'bookings', 'users', 'booking_stats', 'users_stats'));
    }
    public function bookFullDay(Request $request)
    {
        $request->validate([
            'booking_date' => 'required|date',
        ]);

        $date = $request->booking_date;
        $userId = auth()->id();

        // Get all time slots
        $timeSlots = TimeSlot::all();

        foreach ($timeSlots as $slot) {

            // Prevent double booking
            $alreadyBooked = Booking::where('booking_date', $date)
                ->where('time_slot_id', $slot->id)
                ->exists();

            if ($alreadyBooked) {
                return back()->with('status', 'Some slots are already booked for this day.');
            }
        }

        foreach ($timeSlots as $slot) {
            Booking::create([
                'user_id' => $userId,
                'club_room_id' => 1,
                'booking_date' => $date,
                'time_slot_id' => $slot->id,
            ]);
        }

        return back()->with('status', 'Full day booked successfully.');
    }
}
