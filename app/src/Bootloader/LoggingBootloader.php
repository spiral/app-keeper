<?php

declare(strict_types=1);

namespace App\Bootloader;

use Monolog\Logger;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Http\Middleware\ErrorHandlerMiddleware;
use Spiral\Monolog\Bootloader\MonologBootloader;
use Spiral\Monolog\Config\MonologConfig;

class LoggingBootloader extends Bootloader
{
    /**
     * @param MonologBootloader $monolog
     */
    public function init(MonologBootloader $monolog): void
    {
        // http level errors
        $monolog->addHandler(ErrorHandlerMiddleware::class, $monolog->logRotate(
            directory('runtime') . 'logs/http.log'
        ));

        // app level errors
        $monolog->addHandler(MonologConfig::DEFAULT_CHANNEL, $monolog->logRotate(
            directory('runtime') . 'logs/error.log',
            Logger::ERROR,
            25,
            false
        ));

        // debug and info messages via global LoggerInterface
        $monolog->addHandler(MonologConfig::DEFAULT_CHANNEL, $monolog->logRotate(
            directory('runtime') . 'logs/debug.log'
        ));
    }
}
