<?php

namespace database\seeders;

use App\Enums\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = config('permission.permissions');

        foreach ($permissions as $resource) {
            foreach ($resource as $permission) {
                Permission::findOrCreate($permission);
            }
        }

        if (!Role::where('name', Roles::CUSTOMER->value)->exists()) {
            (Role::create(['name' => Roles::CUSTOMER->value]))
                ->givePermissionTo(array_values($permissions['account']));
        }

        if (!Role::where('name', Roles::MODERATOR->value)->exists()) {
            $moderatorPermissions = array_merge(
                array_values($permissions['categories']),
                array_values($permissions['products'])
            );

            (Role::create(['name' => Roles::MODERATOR->value]))
                ->givePermissionTo($moderatorPermissions);
        }

        if (!Role::where('name', Roles::ADMIN->value)->exists()) {
            (Role::create(['name' => Roles::ADMIN->value]))
                ->givePermissionTo(Permission::all());
        }
    }
}
