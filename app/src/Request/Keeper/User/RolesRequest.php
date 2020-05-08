<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Request\Keeper\User;

use App\Bootloader\SecurityBootloader;
use App\Database\User;
use Spiral\Filters\Filter;

/**
 * @property array $roles
 */
class RolesRequest extends Filter
{
    protected const SCHEMA = [
        'roles' => 'data:roles'
    ];

    protected const VALIDATES = [
        'roles' => [
            ['notEmpty', 'error' => 'At least one role is required.'],
            ['array'],
            [[self::class, 'validRoles'], 'error' => 'Invalid roles.']
        ]
    ];

    /**
     * @param User $user
     * @return User
     */
    public function map(User $user): User
    {
        $user->roles = join(',', $this->roles);
        return $user;
    }

    /**
     * @param array $roles
     * @return bool
     */
    public static function validRoles(array $roles): bool
    {
        foreach ($roles as $role) {
            if (!isset(SecurityBootloader::ROLES[$role])) {
                return false;
            }
        }

        return true;
    }
}
