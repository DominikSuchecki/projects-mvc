<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        //admin
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'position' => 'Admin',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
