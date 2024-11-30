<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    private $permissions = [
        'dashboard' => [
            'view',
        ],

        'user' => [
            'view',
            'create',
            'update',
            'delete',
        ],

        'role' => [
            'view',
            'create',
            'update',
            'delete',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $key => $value) {
            foreach ($value as $permission) {
                Permission::firstOrCreate([
                    'name' => $key . '-' . $permission,
                ]);
            }
        }

        Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ])->givePermissionTo(Permission::all());
    }
}
