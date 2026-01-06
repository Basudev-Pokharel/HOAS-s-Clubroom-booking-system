<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ClubRoomBookController extends Controller
{
    public function getNumberOfBooked()
    {
        $data = Booking::where('user_id', auth()->id)->whereMonth('booking_date', now()->month)->whereYear('booking_date', now()->year);
        
    }
}
