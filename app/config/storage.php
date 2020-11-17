<?php

declare(strict_types=1);

use Spiral\Storage\Server;

return [
    'servers' => [
        'local'     => [
            'class'   => Server\LocalServer::class,
            'options' => [
                'home' => directory('public')
            ]
        ],
    ],

    'buckets' => [
        'uploads' => [
            'server'  => 'local',
            'prefix'  => '/uploads/',
            'options' => [
                //Directory has to be specified relatively to root directory of associated server
                'directory' => 'uploads/'
            ]
        ],
    ]
];
