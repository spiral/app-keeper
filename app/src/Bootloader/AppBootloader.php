<?php

declare(strict_types=1);

namespace App\Bootloader;

use App\Service\Writeaway\MetaProvider;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Writeaway\Service\MetaProviderInterface;

class AppBootloader extends Bootloader
{
    protected const BINDINGS = [
        MetaProviderInterface::class => MetaProvider::class
    ];
}
