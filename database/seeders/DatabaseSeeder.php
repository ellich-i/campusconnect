<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // role is not mass-assignable, but factories bypass the guard.
        // This is the ONLY place admins are created.
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@campusconnect.test',
            'role' => 'admin',
        ]);

        // Default password of factory users is "password"; role defaults to student
        $students = User::factory()->count(5)->create();

        foreach (['Academic', 'Arts', 'Recreation', 'Social', 'Peer Support'] as $name) {
            Category::create(['name' => $name]);
        }

        foreach (['Library', 'Canteen', 'Open Field', 'Room 101', 'Quadrangle'] as $name) {
            Location::create(['name' => $name]);
        }

        // Relationship create() fills organizer_id for us
        $students[0]->organizedEvents()->create([
            'category_id' => 1,
            'location_id' => 1,
            'title' => 'Group Study: Database Midterm',
            'description' => 'Review normalization and SQL together.',
            'event_date' => now()->addDays(2)->toDateString(),
            'start_time' => '13:00',
            'end_time' => '15:00',
            'capacity' => 10,
        ]);

        $students[1]->organizedEvents()->create([
            'category_id' => 2,
            'location_id' => 3,
            'title' => 'Sketch Hour',
            'description' => 'Bring a pencil and draw with us.',
            'event_date' => now()->addDays(3)->toDateString(),
            'start_time' => '10:00',
            'end_time' => '11:30',
            'capacity' => 2,
        ]);
    }
}