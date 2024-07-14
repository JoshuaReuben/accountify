<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            // 'name' => fake()->name(),
            // // 'email' => fake()->unique()->safeEmail(),
            // 'email' => 'joshuareubenc.v1@gmail.com',
            // 'email_verified_at' => now(),
            // 'role' => 'Super Admin',
            // 'avatar' => 'profile-photos/user-profile-default.jpg',
            // 'password' => Hash::make('123123123'),
        ]);
    }
}
