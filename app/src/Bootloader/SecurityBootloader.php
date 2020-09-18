<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Bootloader;

use App\Repository\UserRepository;
use App\Security\Rule\NotSelfOrOtherAdminRule;
use App\Security\Rule\NotSelfRule;
use App\Security\Rule\SelfRule;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Bootloader\Auth\AuthBootloader;
use Spiral\Security\PermissionsInterface;
use Spiral\Security\Rule\AllowRule;
use Spiral\Security\Rule\ForbidRule;

class SecurityBootloader extends Bootloader
{
    // available roles and their labels
    public const ROLES = [
        'user'        => 'User',
        'admin'       => 'Administrator',
        'super-admin' => 'Super Administrator'
    ];

    protected const DEPENDENCIES = [
        AuthBootloader::class
    ];

    /**
     * @param AuthBootloader       $auth
     * @param PermissionsInterface $permissions
     */
    public function boot(AuthBootloader $auth, PermissionsInterface $permissions): void
    {
        $auth->addActorProvider(UserRepository::class);

        $permissions->addRole('guest');
        $permissions->addRole('user');
        $permissions->addRole('admin');
        $permissions->addRole('super-admin');

        $permissions->associate('admin', 'keeper.*', AllowRule::class);
        $permissions->associate('super-admin', 'keeper.*', AllowRule::class);

        $permissions->associate('admin', 'keeper.*.*', AllowRule::class);
        $permissions->associate('super-admin', 'keeper.*.*', AllowRule::class);

        $permissions->associate('admin', 'keeper.*.*.*', AllowRule::class);
        $permissions->associate('super-admin', 'keeper.*.*.*', AllowRule::class);

        // only possible for the same user to update himself, internal permission
        $permissions->associate('admin', 'self.update', SelfRule::class);
        $permissions->associate('super-admin', 'self.update', SelfRule::class);

        // can't change roles and password of self
        $permissions->associate('super-admin', 'users.delete', NotSelfRule::class);
        $permissions->associate('super-admin', 'users.security', NotSelfRule::class);
        $permissions->associate('super-admin', 'users.password', NotSelfRule::class);
        $permissions->associate('super-admin', 'users.roles', NotSelfRule::class);
        $permissions->associate('super-admin', 'users.update', AllowRule::class);
        $permissions->associate('super-admin', 'users.create', AllowRule::class);

        // admin can't delete other admins or change roles
        $permissions->associate('admin', 'users.delete', NotSelfOrOtherAdminRule::class);
        $permissions->associate('admin', 'users.security', NotSelfOrOtherAdminRule::class);

        $permissions->associate('admin', 'users.password', NotSelfOrOtherAdminRule::class);
        $permissions->associate('admin', 'users.roles', ForbidRule::class);
        $permissions->associate('admin', 'users.update', NotSelfOrOtherAdminRule::class);
        $permissions->associate('admin', 'users.create', AllowRule::class);
    }
}
