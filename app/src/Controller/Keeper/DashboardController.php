<?php

declare(strict_types=1);

namespace App\Controller\Keeper;

use Spiral\Keeper\Annotation as Keeper;
use Spiral\Prototype\Traits\PrototypeTrait;

#[Keeper\Controller(name: 'dashboard', prefix: '', defaultAction: 'index')]
class DashboardController
{
    use PrototypeTrait;

    #[Keeper\Action(route: '', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'Dashboard', parent: 'root', options: ['icon' => 'home'], position: 1.0)]
    public function index(): string
    {
        return $this->views->render('keeper/dashboard');
    }

    #[Keeper\Action(route: '/do', methods: 'POST')]
    public function do(): array
    {
        return [
            'status'  => 200,
            'message' => 'Done something!',
        ];
    }
}
