<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App\View;

use App\Database\User;
use Spiral\DataGrid\GridSchema;
use Spiral\DataGrid\Specification\Filter as Filter;
use Spiral\DataGrid\Specification\Pagination\PagePaginator;
use Spiral\DataGrid\Specification\Sorter as Sorter;
use Spiral\DataGrid\Specification\Value;

class UserGrid extends GridSchema
{
    public function __construct()
    {
        $this->addFilter(
            'search',
            new Filter\Any(
                new Filter\Like('firstName'),
                new Filter\Like('lastName'),
                new Filter\Like('email')
            )
        );

        $this->addFilter(
            'id',
            new Filter\InArray('id', new Value\NumericValue())
        );

        $this->addSorter('created', new Sorter\Sorter('createdAt'));
        $this->addSorter('name', new Sorter\Sorter('firstName', 'lastName'));
        $this->addSorter('email', new Sorter\Sorter('email'));

        $this->setPaginator(new PagePaginator(20, [10, 20, 50, 100]));
    }

    /**
     * @return array
     */
    public function getDefaults(): array
    {
        return ['sort' => ['created' => 'desc']];
    }

    /**
     * @param User $user
     * @return array
     */
    public function __invoke(User $user): array
    {
        return [
            'id'        => $user->id,
            'created'   => $user->getCreatedAt()->format(DATE_ATOM),
            'firstName' => $user->firstName,
            'lastName'  => $user->lastName,
            'email'     => $user->email,
            'roles'     => $user->getRoles()
        ];
    }
}
