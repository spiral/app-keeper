<?php

declare(strict_types=1);

namespace App\Request\Keeper\User;

use App\Bootloader\SecurityBootloader;
use App\Database\User;
use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;

class RolesRequest extends Filter implements HasFilterDefinition
{
    #[Post]
    public readonly array $roles;

    public function map(User $user): User
    {
        $user->roles = \implode(',', $this->roles);

        return $user;
    }

    public static function validRoles(array $roles): bool
    {
        foreach ($roles as $role) {
            if (!isset(SecurityBootloader::ROLES[$role])) {
                return false;
            }
        }

        return true;
    }

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'roles' => [
                'array',
                ['required', 'error' => '[[At least one role is required.]]'],
                [[self::class, 'validRoles'], 'error' => '[[Invalid roles.]]'],
            ],
        ]);
    }
}
