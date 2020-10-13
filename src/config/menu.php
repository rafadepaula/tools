<?php

    return [
        'icons_class' => 'metismenu-icon',
        'heading_class' => 'app-sidebar__heading',
        'menus' => [
            'default' => [
                'Geral' => [
                    [
                        'route' => 'home_index',
                        'icon' => 'pe-7s-graph',
                        'text' => 'Dashboard'
                    ]
                ],
				'Administração' => [
					[
						'route' => 'user_index',
						'icon' => 'pe-7s-users',
						'text' => 'Administradores'
					]
				]
            ]
        ]
    ];