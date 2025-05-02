<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $roles = config('roles_permissions.roles_permissions_config.roles');
        $permissions = config('roles_permissions.roles_permissions_config.permissions');

        $flatArray = [];    // Permisos en un array plano

        foreach ($permissions as $permission) {

            $flatArray[] = $permission['name'];

            if (!empty($permission['childrens'])) {

                foreach ($permission['childrens'] as $child) {
                    $flatArray[] = $child['name'];
                }
            }
        }

        // Crear todos los permisos
        foreach ($flatArray as $permName) {
            Permission::create(['name' => $permName]);
        }

        // Crear roles y asignar permisos
        foreach ($roles as $roleName => $permission) {
            $role = Role::create(['name' => $roleName]);

            $permission === 'all' ? $role->syncPermissions(Permission::all()) : $role->syncPermissions($permission);
        }
    }
}
