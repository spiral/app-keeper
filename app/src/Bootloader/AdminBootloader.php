<?php

declare(strict_types=1);

namespace App\Bootloader;

use App\Controller\Keeper\DashboardController;
use App\Interceptor\ValidationInterceptor;
use Spiral\DataGrid\Interceptor\GridInterceptor;
use Spiral\Cycle\Interceptor\CycleInterceptor;
use Spiral\Domain\GuardInterceptor;
use Spiral\Keeper\Bootloader as Keeper;
use Spiral\Keeper\Bootloader\KeeperBootloader;
use Spiral\Keeper\Middleware\LoginMiddleware;

class AdminBootloader extends KeeperBootloader
{
    protected const DEFAULT_CONTROLLER = DashboardController::class;
    protected const PREFIX             = '/keeper';
    protected const LOAD               = [
        Keeper\UIBootloader::class,
        Keeper\SitemapBootloader::class,
        Keeper\AnnotatedBootloader::class,
    ];

    protected const INTERCEPTORS = [
        CycleInterceptor::class,
        GuardInterceptor::class,
        ValidationInterceptor::class,
        GridInterceptor::class,
    ];

    protected const MIDDLEWARE = [
        LoginMiddleware::class,
    ];
}
