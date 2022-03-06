<?php

declare(strict_types=1);

return [
    /**
     * -------------------------------------------------------------------------
     *  Default Distribution Resolver Name
     * -------------------------------------------------------------------------
     *
     * Here you can specify which of the resolvers you want to use in the
     * default for all work with URI generation. Of course, you can use
     * multiple resolvers at the same time using the distribution library.
     *
     */

    'default' => 'local',

    /**
     * -------------------------------------------------------------------------
     *  Distribution Resolvers
     * -------------------------------------------------------------------------
     *
     * Here are each of the resolvers is configured for your application.
     * Of course, examples of customizing each available distribution supported
     * by Spiral are shown below to simplify development.
     *
     */

    'resolvers' => [
        'local' => [
            'type' => 'static',
            'uri'  => env('APP_URL', 'http://localhost') . '/uploads'
        ],
    ],
];
