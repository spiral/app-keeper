<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App\Controller\Keeper;

use Spiral\Keeper\Annotation as Keeper;
use Spiral\Prototype\Traits\PrototypeTrait;

/**
 * @Keeper\Controller(name="dashboard", prefix="")
 */
class DashboardController
{
    use PrototypeTrait;

    /**
     * @Keeper\Action(route="/", methods="GET")
     * @Keeper\Sitemap\Link(title="Dashboard", parent="root", options={"icon": "home"})
     */
    public function index()
    {
        return $this->views->render('keeper/dashboard');
    }

    /**
     * @Keeper\Action(route="/showcase", methods="GET")
     * @Keeper\Sitemap\Link(title="Keeper Showcase", parent="root", options={"icon": "bahai"})
     */
    public function showcase()
    {
        return $this->views->render('keeper:showcase');
    }

    /**
     * @Keeper\Action(route="/do", methods="POST")
     */
    public function do()
    {
        return [
            'status'  => 200,
            'message' => 'Done something!'
        ];
    }
}
