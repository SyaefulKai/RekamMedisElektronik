<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = collect([
            'dashboard' => [
                'view'
            ],
            'registration' => [
                'view',
                'create',
                'update',
                'delete'
            ],
            'medical-record' => [
                'read',
                'create',
                'update',
                'delete'
            ]
        ]);

        $permissions->each(function ($actions, $category) {
            foreach ($actions as $action) {
                Permission::create([
                    "name" => "$action.$category"
                ]);
            }
        });
    }
}
