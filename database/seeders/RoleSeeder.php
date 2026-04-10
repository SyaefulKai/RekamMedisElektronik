<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect([
            'Admin',
            'Dokter',
            'Staff'
        ]);

        $roles->each(function($role) {
            Role::create([
                'name' => $role
            ]);
        });
    }
}
