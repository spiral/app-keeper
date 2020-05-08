<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App\Bootloader;

use Spiral\DataGrid\Interceptor\GridInterceptor;
use Spiral\Domain\CycleInterceptor;
use Spiral\Domain\FilterInterceptor;
use Spiral\Domain\GuardInterceptor;
use Spiral\Keeper\Bootloader as Keeper;
use Spiral\Keeper\Bootloader\KeeperBootloader;
use Spiral\Keeper\Middleware\LoginMiddleware;

class AdminBootloader extends KeeperBootloader
{
    protected const LOAD = [
        Keeper\UIBootloader::class,
        Keeper\SitemapBootloader::class,
        Keeper\AnnotatedBootloader::class,
    ];

    protected const INTERCEPTORS = [
        CycleInterceptor::class,
        GuardInterceptor::class,
        FilterInterceptor::class,
        GridInterceptor::class,
    ];

    protected const MIDDLEWARE = [
        LoginMiddleware::class
    ];
}
