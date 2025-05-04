<?php

return [
    'name' => 'Insumos',
    'icon' => '<i class="fa-solid fa-dolly text-white"></i>',
    'permission' => 'Dashboard',
    'id_drop' => 'dropdown-insumos',
    'prefix_route' => [0 => 'insumos'],
    'childrens' => [
        [
            'name' => 'Catálogos',
            'icon' => '<i class="fa-solid fa-folder-tree text-white"></i>',
            'permission' => 'Inventario',
            'id_drop' => 'dropdown-insumos-catalogos',
            'prefix_route' => [0 => 'insumos', 1 => 'catalogos'],
            'childrens' => [
                [
                    'name' => 'Insumos',
                    'permission' => 'Inventario',
                    // 'link' => 'entity.resource.view',
                ],
            ],
        ],
    ],
];
