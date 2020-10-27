<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Job\Ping;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class HomeController
{
    use PrototypeTrait;

    /**
     * @Route(route="/", name="index", methods="GET")
     */
    public function index()
    {
        return $this->views->render('home');
    }

    /**
     * @Route(route="/exception.html", name="exception", methods="GET")
     */
    public function exception(): void
    {
        echo $undefined;
    }

    /**
     * @Route(route="/ping.html", name="ping", methods="GET")
     */
    public function ping(): string
    {
        $jobID = $this->queue->push(
            Ping::class,
            ['value' => 'hello world']
        );

        return sprintf('Job ID: %s', $jobID);
    }

    /**
     * Fetches notifications for notification drawer
     * Only include here recent notifications
     * Implement datagrid for complete list if needed
     * @Route(route="/notifications", methods="GET")
     */
    public function notifications(): array
    {
        return [
            'status' => 200,
            'unreadCount' => 1,
            'data' => [
                [
                    'title' => 'Hello!',
                    'body' => 'Real time notifications are now supported. Click <a href="https://github.com/spiral/toolkit/tree/master/packages/notifications">here</a> to read documentation',
                    'read' => false,
                    'icon' => 'download',
                    'date' => 1597828433980,
                    'id' => '1'
                ],
            ]
        ];
    }
}
