<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Account
        User::updateOrCreate(
            ['email' => 'admin@terra-sdgs.id'],
            [
                'name' => 'Gavril Ghazanfar',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Regular User Account
        User::updateOrCreate(
            ['email' => 'user@terra-sdgs.id'],
            [
                'name' => 'Budi Volunteer',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
}
