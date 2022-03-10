<?php

declare(strict_types=1);

return [
    'servers' => [
        'local' => [
            'adapter' => 'local',
            'directory' => directory('public') . 'uploads',
        ],
    ],

    'buckets' => [
        'uploads' => [
            'server'  => 'local',
            'distribution' => 'local',
        ],
    ],
];
