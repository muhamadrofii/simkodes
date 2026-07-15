<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('kopmerahputih'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'kdmpsranak@gmail.com'],
            [
                'name' => 'Admin KDMPS Ranak',
                'password' => Hash::make('kopmerahputih'),
            ]
        );
    }
}
