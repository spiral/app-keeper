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

#[Keeper\Controller(name: 'showcase', prefix: '/showcase')]
#[Keeper\Sitemap\Group(name: 'showcase', title: 'Showcase', options: ['icon' => 'cog'], position: 3.0)]
class ShowcaseController
{
    use PrototypeTrait;

    #[Keeper\Action(route: '', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'Short Intro', options: ['icon' => 'eye'])]
    public function index(): string
    {
        return $this->views->render('keeper/showcase/intro');
    }

    #[Keeper\Action(route: '/forms', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'Forms', parent: 'showcase', options: ['icon' => 'list-alt'])]
    public function showcaseForms(): string
    {
        return $this->views->render('keeper/showcase/forms');
    }

    #[Keeper\Action(route: '/autocomplete', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'Autocomplete', parent: 'showcase', options: ['icon' => 'i-cursor'])]
    public function showcaseAutocomplete(): string
    {
        return $this->views->render('keeper/showcase/autocomplete');
    }

    #[Keeper\Action(route: '/tinymce', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'Rich Text Editor', parent: 'showcase', options: ['icon' => 'edit'])]
    public function showcaseRichText(): string
    {
        return $this->views->render('keeper/showcase/tinymce');
    }

    #[Keeper\Action(route: '/codeeditor', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'Code Editor', parent: 'showcase', options: ['icon' => 'code'])]
    public function showcaseCodeEditor(): string
    {
        return $this->views->render('keeper/showcase/codeeditor');
    }

    #[Keeper\Action(route: '/datepicker', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'Datepicker', parent: 'showcase', options: ['icon' => 'calendar'])]
    public function showcaseDatepicker(): string
    {
        return $this->views->render('keeper/showcase/datepicker');
    }

    #[Keeper\Action(route: '/qrcode', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'QR Codes', parent: 'showcase', options: ['icon' => 'qrcode'])]
    public function showcaseQrCodes(): string
    {
        return $this->views->render('keeper/showcase/qrcode');
    }

    #[Keeper\Action(route: '/datagrid', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'Datagrids', parent: 'showcase', options: ['icon' => 'table'])]
    public function showcaseDataGrids(): string
    {
        return $this->views->render('keeper/showcase/datagrids');
    }
}
