<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;  // Pastikan meng-import Role model dari Spatie

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat role administrator
        Role::create(['name' => 'administrator']);

        // Membuat role officer
        Role::create(['name' => 'officer']);

        // Membuat role visitor
        Role::create(['name' => 'visitor']);
    }
}