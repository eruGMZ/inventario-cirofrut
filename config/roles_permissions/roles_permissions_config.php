<?php

use App\Services\RolePermissionService;

return [
    'roles' => RolePermissionService::getRoles(),
    'permissions' => RolePermissionService::getPermissions(),
];
