<?php

declare(strict_types=1);

namespace App;

use App\Bootloader;
use Spiral\Bootloader as Framework;
use Spiral\DotEnv\Bootloader as DotEnv;
use Spiral\Framework\Kernel;
use Spiral\Monolog\Bootloader as Monolog;
use Spiral\Nyholm\Bootloader as Nyholm;
use Spiral\Prototype\Bootloader as Prototype;
use Spiral\Router\Bootloader as Router;
use Spiral\Scaffolder\Bootloader as Scaffolder;
use Spiral\Stempler\Bootloader as Stempler;
use Spiral\Writeaway\Bootloader as Writeaway;
use Spiral\Cycle\Bootloader as CycleBridge;
use Spiral\RoadRunnerBridge\Bootloader as RoadRunnerBridge;

class App extends Kernel
{
    /*
     * List of components and extensions to be automatically registered
     * within system container on application start.
     */
    protected const LOAD = [
        /** -- roadrunner -- */
        RoadRunnerBridge\HttpBootloader::class,
        RoadRunnerBridge\QueueBootloader::class,
        RoadRunnerBridge\CommandBootloader::class,

        /* -- debug and profiling --*/
        DotEnv\DotenvBootloader::class,
        Monolog\MonologBootloader::class,
        Framework\SnapshotsBootloader::class,
        Framework\DebugBootloader::class,
        Framework\Debug\LogCollectorBootloader::class,
        Framework\Debug\HttpCollectorBootloader::class,

        /* -- application specific logging --*/
        Bootloader\LoggingBootloader::class,

        /* -- validation, security and encryption --*/
        Framework\Security\EncrypterBootloader::class,
        Framework\Security\ValidationBootloader::class,
        Framework\Security\FiltersBootloader::class,
        Framework\Security\GuardBootloader::class,

        /* -- HTTP --*/
        Nyholm\NyholmBootloader::class,
        Framework\Http\ErrorHandlerBootloader::class,
        Framework\Http\CookiesBootloader::class,
        Framework\Http\SessionBootloader::class,
        Framework\Http\CsrfBootloader::class,
        Framework\Http\PaginationBootloader::class,
        Framework\Http\RouterBootloader::class,
        Framework\Http\JsonPayloadsBootloader::class,

        /* -- ORM and databases --*/
        CycleBridge\DatabaseBootloader::class,
        CycleBridge\MigrationsBootloader::class,
        CycleBridge\DisconnectsBootloader::class,
        CycleBridge\SchemaBootloader::class,
        CycleBridge\CycleOrmBootloader::class,
        CycleBridge\AnnotatedBootloader::class,
        CycleBridge\CommandBootloader::class,
        Writeaway\WriteawayBootloader::class,
        Writeaway\WriteawayCommandBootloader::class,
        Writeaway\WriteawayViewsBootloader::class,

        /* -- stempler and views --*/
        Framework\Views\ViewsBootloader::class,
        Framework\Views\TranslatedCacheBootloader::class,
        Stempler\StemplerBootloader::class,
        Stempler\PrettyPrintBootloader::class,

        /* -- security and auth context --*/
        Framework\Auth\HttpAuthBootloader::class,
        CycleBridge\AuthTokensBootloader::class,
        Framework\Auth\SecurityActorBootloader::class,

        /* -- other components --*/
        Framework\I18nBootloader::class,
        Framework\Storage\StorageBootloader::class,
        Framework\Distribution\DistributionBootloader::class,

        /* -- data rendering --*/
        CycleBridge\DataGridBootloader::class,

        /* -- routes and middleware -- */
        Router\AnnotatedRoutesBootloader::class,
        Bootloader\LocaleSelectorBootloader::class,

        /* -- security and admin panels --*/
        Bootloader\SecurityBootloader::class,
        Bootloader\AdminBootloader::class,

        /* -- development helpers --*/
        Framework\CommandBootloader::class,
        Prototype\PrototypeBootloader::class,
        Scaffolder\ScaffolderBootloader::class,

        //App
        Bootloader\AppBootloader::class,
    ];
}
