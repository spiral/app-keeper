<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App\Controller\Keeper;

use App\Database\User;
use App\Request\Keeper\User\CreateRequest;
use App\Request\Keeper\User\RolesRequest;
use App\Request\Keeper\User\UpdatePasswordRequest;
use App\Request\Keeper\User\UpdateRequest;
use App\View\UserGrid;
use Cycle\ORM\Select;
use Spiral\DataGrid\Annotation\DataGrid;
use Spiral\Domain\Annotation\Guarded;
use Spiral\Keeper\Annotation as Keeper;
use Spiral\Keeper\Module\RouteRegistry;
use Spiral\Prototype\Traits\PrototypeTrait;

/**
 * @Keeper\Controller(name="showcase")
 * @Keeper\Sitemap\Group(name="showcase", title="Showcase", options={"icon": "cog"})
 */
class ShowcaseController
{
    use PrototypeTrait;

    /**
     * @Keeper\Action(route="", methods="GET")
     * @Keeper\Sitemap\Link(title="Short Intro", options={"icon": "eye"})
     */
    public function index()
    {
        return $this->views->render('keeper/showcase/intro');
    }

    /**
     * @Keeper\Action(route="/showcase/forms", methods="GET")
     * @Keeper\Sitemap\Link(title="Forms", parent="showcase", options={"icon": "list-alt"})
     */
    public function showcaseForms()
    {
        return $this->views->render('keeper/showcase/forms');
    }

    /**
     * @Keeper\Action(route="/showcase/autocomplete", methods="GET")
     * @Keeper\Sitemap\Link(title="Autocomplete", parent="showcase", options={"icon": "i-cursor"})
     */
    public function showcaseAutocomplete()
    {
        return $this->views->render('keeper/showcase/autocomplete');
    }

    /**
     * @Keeper\Action(route="/showcase/tinymce", methods="GET")
     * @Keeper\Sitemap\Link(title="Rich Text Editor", parent="showcase", options={"icon": "edit"})
     */
    public function showcaseRichText()
    {
        return $this->views->render('keeper/showcase/tinymce');
    }

    /**
     * @Keeper\Action(route="/showcase/datepicker", methods="GET")
     * @Keeper\Sitemap\Link(title="Datepicker", parent="showcase", options={"icon": "calendar"})
     */
    public function showcaseDatepicker()
    {
        return $this->views->render('keeper/showcase/datepicker');
    }

    /**
     * @Keeper\Action(route="/showcase/qrcode", methods="GET")
     * @Keeper\Sitemap\Link(title="QR Codes", parent="showcase", options={"icon": "qrcode"})
     */
    public function showcaseQrCodes()
    {
        return $this->views->render('keeper/showcase/qrcode');
    }

    /**
     * @Keeper\Action(route="/showcase/datagrid", methods="GET")
     * @Keeper\Sitemap\Link(title="Datagrids", parent="showcase", options={"icon": "table"})
     */
    public function showcaseDataGrids()
    {
        return $this->views->render('keeper/showcase/datagrids');
    }
}
