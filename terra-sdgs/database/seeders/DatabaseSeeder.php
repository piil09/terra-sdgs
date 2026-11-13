<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        // 3. Events Seeder
        $eventsData = [
            [
                'title' => 'Beach Clean-up at Ancol',
                'slug' => 'beach-clean-up-ancol',
                'category' => 'Clean Up',
                'status' => 'Registration is open',
                'description' => 'Join us for a morning of environmental action as we clean up Ancol Beach and help protect marine life.',
                'date' => '15 November 2024',
                'time' => '07:00 - 12:00 WIB',
                'location' => 'Ancol Beach',
                'quota' => '50/100 participants',
                'registered_count' => 50,
                'image' => '/images/about_1.png',
            ],
            [
                'title' => 'Zero Waste Living Workshop',
                'slug' => 'zero-waste-living-workshop',
                'category' => 'Workshop',
                'status' => 'Registration is open',
                'description' => 'Practical training to reduce household waste and make environmentally friendly products.',
                'date' => '22 October 2024',
                'time' => '13:00 - 17:00 WIB',
                'location' => 'Center Kemang',
                'quota' => '25/30 participants',
                'registered_count' => 25,
                'image' => '/images/event_zerowaste.png',
            ],
            [
                'title' => 'River Clean Up Action',
                'slug' => 'river-clean-up-action',
                'category' => 'Clean Up',
                'status' => 'Registration is open',
                'description' => 'River clean-up action and socialization of the importance of maintaining water cleanliness.',
                'date' => '29 October 2024',
                'time' => '07:00 - 11:00 WIB',
                'location' => 'River Ciliwung',
                'quota' => '80/150 participants',
                'registered_count' => 80,
                'image' => '/images/program_waste.jpeg',
            ],
            [
                'title' => 'Penanaman 1.000 Mangrove Teluk Benoa',
                'slug' => 'penanaman-mangrove-benoa',
                'category' => 'Reboisasi',
                'status' => 'Registration is open',
                'description' => 'Aksi penanaman 1.000 bibit mangrove di kawasan pesisir Teluk Benoa untuk mencegah abrasi dan restorasi ekosistem.',
                'date' => '05 Desember 2024',
                'time' => '07:00 - 12:00 WITA',
                'location' => 'Teluk Benoa, Bali',
                'quota' => '80/100 participants',
                'registered_count' => 80,
                'image' => '/images/about_2.png',
            ],
        ];

        foreach ($eventsData as $ev) {
            Event::updateOrCreate(
                ['slug' => $ev['slug']],
                $ev
            );
        }
    }
}
