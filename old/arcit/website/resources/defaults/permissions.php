<?php

return [
    'roles' => [
        [
            'extends' => 'users',
            'name' => 'users',
            'default' => true,
            'permissions' => [
               [
                   'name' => 'projects.create',
                   'restrictions' => [
                       ['name' => 'count', 'value' => 8],
                   ]
               ],
               'editors.enable',
               'plans.view',
               'templates.view',
               'custom_domains.create',
           ]
        ],
        [
            'extends' => 'guests',
            'name' => 'guests',
            'guests' => true,
            'permissions' => [
                //
            ]
        ]
    ],
    'all' => [
        'builder' => [
            [
                'name' => 'projects.publish',
                'description' => 'Allow user to publish projects to their own FTP server.'
            ],
            [
                'name' => 'editors.enable',
                'description' => 'Allow user to use html,css and js code editors.'
            ],
            [
                'name' => 'projects.download',
                'description' => 'Allow user to download their project .zip file.'
            ]
        ],

        'projects' => [
            ['name' => 'projects.view'],
            [
                'name' => 'projects.create',
                'restrictions' => [
                    [
                        'name' => 'count',
                        'type' => 'number',
                        'description' => __('policies.count_description', ['resources' => 'projects']),
                    ],
                ]
            ],
            ['name' => 'projects.update'],
            ['name' => 'projects.delete'],
        ],

        'templates' => [
            ['name' => 'templates.view'],
            ['name' => 'templates.create'],
            ['name' => 'templates.update'],
            ['name' => 'templates.delete'],
        ],

        'plans' => [
            ['name' => 'plans.view'],
            ['name' => 'plans.create'],
            ['name' => 'plans.update'],
            ['name' => 'plans.delete'],
        ],
    ]
];
