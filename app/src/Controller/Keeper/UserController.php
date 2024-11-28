<?php

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

#[Keeper\Controller(name: 'users', prefix: '/users')]
#[Keeper\Sitemap\Group(name: 'users', title: 'User Management', options: ['icon' => 'users'], position: 2.0)]
class UserController
{
    use PrototypeTrait;

    #[Keeper\Action(route: '', methods: 'GET')]
    #[Keeper\Sitemap\Link(title: 'Users', options: ['icon' => 'users'])]
    public function index(): string
    {
        return $this->views->render('keeper/user/list');
    }

    #[Keeper\Action(route: '/create', methods: 'GET')]
    #[Keeper\Sitemap\View(parent: 'index', title: 'Create User')]
    public function new(): string
    {
        return $this->views->render('keeper/user/create');
    }

    #[Keeper\Action(route: '', methods: 'PUT')]
    public function create(CreateRequest $request, RouteRegistry $routes): array
    {
        $user = $request->map(new User(), $this->guard, $this->passwords);
        $this->entities->save($user);

        return [
            'status'  => 200,
            'message' => 'User information has been created.',
            'action'  => [
                'redirect' => $routes->uri('users.edit', ['user' => $user->id]),
            ],
        ];
    }

    #[Keeper\Action(route: '/<user:int>', methods: 'GET')]
    #[Keeper\Sitemap\View(parent: 'index', title: 'Edit User')]
    public function edit(User $user): string
    {
        return $this->views->render('keeper/user/edit', compact('user'));
    }

    #[Keeper\Action(route: '/<user:int>', methods: 'POST')]
    #[Guarded(permission: 'users.update', else: 'forbidden')]
    public function update(User $user, UpdateRequest $request): array
    {
        $user = $request->map($user);
        $this->entities->save($user);

        return [
            'status'  => 200,
            'message' => 'User information has been updated.',
            'action'  => 'reload',
        ];
    }

    #[Keeper\Action(route: '/roles/<user:int>', methods: 'POST')]
    #[Guarded(permission: 'users.roles', else: 'forbidden')]
    public function roles(User $user, RolesRequest $request): array
    {
        $user = $request->map($user);
        $this->entities->save($user);

        return [
            'status'  => 200,
            'message' => 'User roles has been updated.',
        ];
    }

    #[Keeper\Action(route: '/password/<user:int>', methods: 'POST')]
    #[Guarded(permission: 'users.password', else: 'forbidden')]
    public function password(User $user, UpdatePasswordRequest $request): array
    {
        $user = $request->map($user, $this->passwords);
        $this->entities->save($user);

        return [
            'status'  => 200,
            'message' => 'User password has been updated.',
        ];
    }

    #[Keeper\Action(route: '/<user:int>', methods: 'DELETE')]
    #[Guarded(permission: 'users.delete', else: 'forbidden')]
    public function delete(User $user): array
    {
        $this->entities->delete($user);

        return [
            'status'  => 200,
            'message' => 'User has been deleted.',
        ];
    }

    #[Keeper\Action(route: '/list', methods: 'GET')]
    #[DataGrid(grid: UserGrid::class)]
    public function list(): Select
    {
        return $this->users->select();
    }

    #[Keeper\Action(route: '/forbidden')]
    #[Keeper\Sitemap\Link(title: 'Forbidden')]
    public function forbidden(): void
    {
    }
}
