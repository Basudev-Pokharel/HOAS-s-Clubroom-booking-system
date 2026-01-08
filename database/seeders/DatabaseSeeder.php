<?php

namespace Database\Seeders;

use App\Models\ClubRoom;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        ClubRoom::create([
            'name' => 'Clubroom',
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        $this->call([
            // UserSeeder::class,
            TimeSlotSeeder::class,
            // BookingSeeder::class
        ]);
    }
}
