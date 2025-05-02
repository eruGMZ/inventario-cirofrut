<?php

return [
    [
        'name' => 'Admin',
        'name_bd' => 'admin',
        'permissions' => 'all',
    ],
    [
        'name' => 'Gerente',
        'name_bd' => 'gerente',
        'permissions' => config('roles_permissions.roles.inventario_roles.gerente'),
    ],
    [
        'name' => 'Almacenista',
        'name_bd' => 'almacenista',
        'permissions' => config('roles_permissions.roles.inventario_roles.almacenista'),
    ],
];
