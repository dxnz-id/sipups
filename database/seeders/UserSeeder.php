<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password'=> bcrypt('sipupslogin'),
            'role' => 'administrator',
        ]);
        User::factory()->create([
            'name' => 'Officer',
            'email' => 'officer@example.com',
            'password'=> bcrypt('sipupslogin'),
            'role' => 'officer',
        ]);
        User::factory()->create([
            'name' => 'Visitor',
            'email' => 'visitor@example.com',
            'password'=> bcrypt('sipupslogin'),
            'role' => 'visitor',
        ]);
    }
}
