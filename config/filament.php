<?php

return [
    'panels' => [
        'admin' => [
            'id' => 'admin',
            'path' => 'admin',
            'login' => [
                'middleware' => ['web', 'auth', 'role:administrator'],
            ],
        ],
        'visitor' => [
            'id' => 'visitor',
            'path' => 'visitor',
            'login' => [
                'middleware' => ['web', 'auth', 'role:visitor'],
            ],
        ],
        'officer' => [
            'id' => 'officer',
            'path' => 'officer',
            'login' => [
                'middleware' => ['web', 'auth', 'role:officer'],
            ],
        ],
    ],
];
