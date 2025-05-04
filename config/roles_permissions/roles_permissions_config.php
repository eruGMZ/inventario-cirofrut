<?php

use App\Services\RolePermissionService;

return [
    'roles_pos_user' => (function () {
        $aux = [];

        foreach (config('roles_permissions.roles_data') as $role) {
            $aux[$role['name_bd']] = $role['name'];
        }
        
        return $aux;
    })(),

    'roles' => RolePermissionService::getRoles(),
    'permissions' => RolePermissionService::getPermissions(),
];
