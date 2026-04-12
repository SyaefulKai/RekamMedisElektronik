<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = collect([
            'dashboard' => ['view'],
            'registration' => ['view', 'create', 'update', 'delete'],
            'medical-record' => ['view', 'create', 'update', 'delete'],
            'user' => ['view', 'create', 'update', 'delete'],
            'role' => ['view', 'create', 'update', 'delete'],
        ]);

        $data = [];

        $permissions->each(function ($actions, $category) use (&$data) {
            foreach ($actions as $action) {
                $data[] = [
                    'name' => "$action.$category",
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        });

        Permission::insert($data);
    }
}
