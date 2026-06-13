<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'admin', 'description' => 'Administrator dengan akses penuh']);
        Role::create(['name' => 'staff', 'description' => 'Staff gudang']);
    }
}
