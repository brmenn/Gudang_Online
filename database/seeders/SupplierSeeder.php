<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'name' => 'PT Sumber Jaya',
            'contact_person' => 'Budi',
            'email' => 'budi@sumberjaya.com',
            'phone' => '081234567890',
            'address' => 'Jakarta',
        ]);

        Supplier::create([
            'name' => 'CV Makmur Bersama',
            'contact_person' => 'Ani',
            'email' => 'ani@makmur.com',
            'phone' => '081234567891',
            'address' => 'Bandung',
        ]);
    }
}
