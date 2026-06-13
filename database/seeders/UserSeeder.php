<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kicau.mania',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@kicau.maina',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'email_verified_at' => now(),
        ]);
    }
}
