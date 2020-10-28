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
     * @Keeper\Action(route="/showcase/forms", methods="GET")
     * @Keeper\Sitemap\Link(title="Forms", parent="showcase", options={"icon": "bahai"})
     */
    public function showcaseForms()
    {
        return $this->views->render('keeper/showcase/forms');
    }

    /**
     * @Keeper\Action(route="/showcase/autocomplete", methods="GET")
     * @Keeper\Sitemap\Link(title="Autocomplete", parent="showcase", options={"icon": "bahai"})
     */
    public function showcaseAutocomplete()
    {
        return $this->views->render('keeper/showcase/autocomplete');
    }

    /**
     * @Keeper\Action(route="/showcase/datepicker", methods="GET")
     * @Keeper\Sitemap\Link(title="Datepicker", parent="showcase", options={"icon": "bahai"})
     */
    public function showcaseDatepicker()
    {
        return $this->views->render('keeper/showcase/datepicker');
    }

    /**
     * @Keeper\Action(route="/showcase/qrcode", methods="GET")
     * @Keeper\Sitemap\Link(title="QR Codes", parent="showcase", options={"icon": "bahai"})
     */
    public function showcaseQrCodes()
    {
        return $this->views->render('keeper/showcase/qrcode');
    }

    /**
     * @Keeper\Action(route="/showcase/datagrid", methods="GET")
     * @Keeper\Sitemap\Link(title="Datagrids", parent="showcase", options={"icon": "bahai"})
     */
    public function showcaseDataGrids()
    {
        return $this->views->render('keeper/showcase/datagrids');
    }

    /**
     * @Keeper\Action(route="/do", methods="POST")
     */
    public function do()
    {
        return [
            'status'  => 200,
            'message' => 'Done something!',
        ];
    }
}
