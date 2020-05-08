<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
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
        if (in_array('admin', $roles) || in_array('super-admin', $roles)) {
            return false;
        }

        return true;
    }
}
