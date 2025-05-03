<?php

return [
    'name' => 'Insumos',
    'icon' => '<i class="fa-solid fa-dolly text-gray-800"></i>',
    'permission' => 'Insumos',
    'id_drop' => 'dropdown-insumos',
    'prefix_route' => [0 => 'insumos'],
    'childrens' => [
        [
            'name' => 'Catálogos',
            'icon' => '<i class="fa-solid fa-folder-tree text-gray-800"></i>',
            'permission' => 'Catálogos',
            'id_drop' => 'dropdown-insumos-catalogos',
            'prefix_route' => [0 => 'insumos', 1 => 'catalogos'],
            'childrens' => [
                [
                    'name' => 'Insumos',
                    'permission' => 'Lista de insumos',
                    'link' => 'catalogo.insumos.index',
                ],
            ]
        ],
    ],
];

