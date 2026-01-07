<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Basu Pokharel',
                'email' => 'basu.pokharel@example.com',
                'address' => 'Oulu, Finland',
                // 'Total_Booked' => 10,
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'isAdmin' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'address' => 'Helsinki, Finland',
                // 'Total_Booked' => 3,
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'isAdmin' => 0,

                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maria Virtanen',
                'email' => 'maria.virtanen@example.com',
                'address' => 'Espoo, Finland',
                // 'Total_Booked' => 7,
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'isAdmin' => 0,

                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alex Johnson',
                'email' => 'alex.johnson@example.com',
                'address' => 'Vantaa, Finland',
                // 'Total_Booked' => 1,
                'email_verified_at' => null,
                'password' => bcrypt('password123'),
                'isAdmin' => 0,

                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sara Laine',
                'email' => 'sara.laine@example.com',
                'address' => 'Tampere, Finland',
                // 'Total_Booked' => 5,
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'isAdmin' => 0,

                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];
        User::insert($users);
    }
}
