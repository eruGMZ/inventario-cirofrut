<?php

namespace App\Services;

class RolePermissionService
{
    public static function getRoles(): array
    {
        $aux = [];

        foreach (config('roles_permissions.roles_data') as $role) {
            $aux[$role['name']] = $role['permissions'];
        }

        return $aux;
    }

    public static function getPermissions(): array
    {
        return config('roles_permissions.permissions');
    }
}
