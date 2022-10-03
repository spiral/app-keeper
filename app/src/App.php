<?php

declare(strict_types=1);

namespace App;

use App\Bootloader;
use Spiral\Boot\Bootloader\CoreBootloader;
use Spiral\Bootloader as Framework;
use Spiral\DataGrid\Bootloader\GridBootloader;
use Spiral\Distribution\Bootloader\DistributionBootloader;
use Spiral\DotEnv\Bootloader as DotEnv;
use Spiral\Framework\Kernel;
use Spiral\Monolog\Bootloader as Monolog;
use Spiral\Nyholm\Bootloader as Nyholm;
use Spiral\Prototype\Bootloader as Prototype;
use Spiral\Router\Bootloader as Router;
use Spiral\Sapi\Bootloader\SapiBootloader;
use Spiral\Scaffolder\Bootloader as Scaffolder;
use Spiral\Stempler\Bootloader as Stempler;
use Spiral\Storage\Bootloader\StorageBootloader;
use Spiral\Tokenizer\Bootloader\TokenizerBootloader;
use Spiral\Validation\Bootloader\ValidationBootloader;
use Spiral\Views\Bootloader\ViewsBootloader;
use Spiral\Writeaway\Bootloader as Writeaway;
use Spiral\Cycle\Bootloader as CycleBridge;
use Spiral\RoadRunnerBridge\Bootloader as RoadRunnerBridge;

class App extends Kernel
{
    protected const SYSTEM = [
        CoreBootloader::class,
        TokenizerBootloader::class,
        DotEnv\DotenvBootloader::class,
    ];

    /*
     * List of components and extensions to be automatically registered
     * within system container on application start.
     */
    protected const LOAD = [
        // Logging and exceptions handling
        Monolog\MonologBootloader::class,
        Bootloader\ExceptionHandlerBootloader::class,

        // Application specific logs
        Bootloader\LoggingBootloader::class,

        // RoadRunner
        RoadRunnerBridge\CacheBootloader::class,
        RoadRunnerBridge\GRPCBootloader::class,
        RoadRunnerBridge\HttpBootloader::class,
        RoadRunnerBridge\QueueBootloader::class,
        RoadRunnerBridge\RoadRunnerBootloader::class,

        // Core Services
        Framework\SnapshotsBootloader::class,
        Framework\I18nBootloader::class,

        // Security and validation
        Framework\Security\EncrypterBootloader::class,
        ValidationBootloader::class,
        Framework\Security\FiltersBootloader::class,
        Framework\Security\GuardBootloader::class,

        // HTTP extensions
        Nyholm\NyholmBootloader::class,
        Framework\Http\RouterBootloader::class,
        Framework\Http\JsonPayloadsBootloader::class,
        Framework\Http\CookiesBootloader::class,
        Framework\Http\SessionBootloader::class,
        Framework\Http\CsrfBootloader::class,
        Framework\Http\PaginationBootloader::class,
        SapiBootloader::class,
        Router\AnnotatedRoutesBootloader::class,

        // Databases
        CycleBridge\DatabaseBootloader::class,
        CycleBridge\MigrationsBootloader::class,
        // CycleBridge\DisconnectsBootloader::class,

        // ORM
        CycleBridge\SchemaBootloader::class,
        CycleBridge\CycleOrmBootloader::class,
        CycleBridge\AnnotatedBootloader::class,
        CycleBridge\CommandBootloader::class,

        // DataGrid
        GridBootloader::class,
        CycleBridge\DataGridBootloader::class,

        // Writeaway
        Writeaway\WriteawayBootloader::class,
        Writeaway\WriteawayCommandBootloader::class,
        Writeaway\WriteawayViewsBootloader::class,

        // Stempler and views
        ViewsBootloader::class,
        Framework\Views\TranslatedCacheBootloader::class,
        Stempler\StemplerBootloader::class,
        Stempler\PrettyPrintBootloader::class,

        // Security and auth context
        Framework\Auth\HttpAuthBootloader::class,
        CycleBridge\AuthTokensBootloader::class,
        Framework\Auth\SecurityActorBootloader::class,

        // Other components
        StorageBootloader::class,
        DistributionBootloader::class,

        // Security and admin panels
        Bootloader\SecurityBootloader::class,
        Bootloader\AdminBootloader::class,

        // Development helpers
        Framework\CommandBootloader::class,
        Scaffolder\ScaffolderBootloader::class,

        // App
        Bootloader\RoutesBootloader::class,
        Bootloader\AppBootloader::class,
    ];

    protected const APP = [
        // fast code prototyping
        Prototype\PrototypeBootloader::class,
    ];
}
