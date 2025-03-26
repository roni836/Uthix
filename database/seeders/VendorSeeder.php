<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are seller users before creating vendors
        if (User::where('role', 'seller')->count() === 0) {
            User::factory()->count(10)->create(['role' => 'seller']);
        }

        // Generate vendor entries
        Vendor::factory()->count(20)->create();
    }
}
