<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $table = 'time_slots';
    protected $guarded = [];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
