<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing data (except users) to prevent duplication
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\Category::truncate();
        \App\Models\Member::truncate();
        \App\Models\Supervisor::truncate();
        \App\Models\Officer::truncate();
        \App\Models\Inventory::truncate();
        \App\Models\IncomingLetter::truncate();
        \App\Models\OutgoingLetter::truncate();
        \App\Models\SubsidyCheck::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            MemberSeeder::class,
            SupervisorSeeder::class,
            OfficerSeeder::class,
            InventorySeeder::class,
            IncomingLetterSeeder::class,
            OutgoingLetterSeeder::class,
            SubsidyCheckSeeder::class,
        ]);
    }
}
