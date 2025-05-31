<?php

namespace Database\Seeders;

use App\Models\MacAddress;
use Illuminate\Database\Seeder;

class MacAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MacAddress::factory()
            ->count(50)
            ->create();
    }
}
