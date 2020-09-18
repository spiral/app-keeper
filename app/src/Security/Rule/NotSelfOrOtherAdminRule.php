<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Security\Rule;

use Spiral\Core\Container\SingletonInterface;
use Spiral\Security\ActorInterface;
use Spiral\Security\RuleInterface;

class NotSelfOrOtherAdminRule implements RuleInterface, SingletonInterface
{
    /**
     * @param ActorInterface $actor
     * @param string         $permission
     * @param array          $context
     * @return bool
     */
    public function allows(ActorInterface $actor, string $permission, array $context): bool
    {
        $roles = $context['user']->getRoles();

        if (in_array('admin', $roles, true) || in_array('super-admin', $roles, true)) {
            return false;
        }

        return true;
    }
}
