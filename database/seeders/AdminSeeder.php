<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::create([
            'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            'email' => 'joshuareubenc.v1@gmail.com',
            'email_verified_at' => now(),
            'role' => 'Super Admin',
            'avatar' => 'profile-photos/user-profile-default.jpg',
            'password' => Hash::make('123123123'),
        ]);


        Admin::create([
            'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            'email' => 'test@gmail.com',
            'email_verified_at' => now(),
            'role' => 'Admin',
            'avatar' => 'profile-photos/user-profile-default.jpg',
            'password' => Hash::make('123123123'),
        ]);
    }
}
