<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@jobfair.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Demo company user
        User::create([
            'name' => 'Demo Company',
            'email' => 'company@jobfair.com',
            'password' => Hash::make('company123'),
            'role' => 'company'
        ]);
    }
}
