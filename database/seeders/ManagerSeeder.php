<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\Clock\now;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
              ['email' => 'manager@example.com'], // prevent duplicates
            [
                'name' => 'System Manager',
                'password' => Hash::make('12345'),
                'role' => 'manager',
                'email_verified_at' => now(),
            ]
        );
    }
}
