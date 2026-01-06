<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function book($timeslot, Request $request)
    {
        $request->validate([
            'booking_date' => 'required',
        ]);
        $is_booked = Booking::create([
            'user_id' => auth()->id(),
            'club_room_id' => 1,
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
}
