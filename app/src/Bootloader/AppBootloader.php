<?php

declare(strict_types=1);

namespace App\Bootloader;

use App\Interceptor\ValidationInterceptor;
use App\Service\Writeaway\MetaProvider;
use Spiral\Bootloader\DomainBootloader;
use Spiral\Core\CoreInterface;
use Spiral\Writeaway\MetaProviderInterface;

class AppBootloader extends DomainBootloader
{
    protected const SINGLETONS = [
        CoreInterface::class => [self::class, 'domainCore'],
    ];

    protected const BINDINGS = [
        MetaProviderInterface::class => MetaProvider::class,
    ];

    protected const INTERCEPTORS = [
        ValidationInterceptor::class,
    ];
}
