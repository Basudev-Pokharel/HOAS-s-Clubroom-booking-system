<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            // December 2025 — user 1
            [
                'user_id' => 1,
                'club_room_id' => 1,
                'time_slot_id' => 3,
                'booking_date' => '2026-01-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'club_room_id' => 1,
                'time_slot_id' => 4,
                'booking_date' => '2026-01-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // December 2025 — user 5
            [
                'user_id' => 5,
                'club_room_id' => 1,
                'time_slot_id' => 6,
                'booking_date' => '2026-01-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // January 2026 (future > 2026-01-05) — user 5
            [
                'user_id' => 5,
                'club_room_id' => 1,
                'time_slot_id' => 8,
                'booking_date' => '2026-01-06',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'club_room_id' => 1,
                'time_slot_id' => 2,
                'booking_date' => '2026-01-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // January 2026 — user 1
            [
                'user_id' => 1,
                'club_room_id' => 1,
                'time_slot_id' => 5,
                'booking_date' => '2026-01-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Booking::insert($bookings);
    }
}
