<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Shahnawaz',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Ahmed Khan',
            'email' => 'ahmed@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}