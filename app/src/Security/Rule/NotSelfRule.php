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

/**
 * True when user related to the same actor.
 */
class NotSelfRule implements RuleInterface, SingletonInterface
{
    /**
     * @param ActorInterface $actor
     * @param string         $permission
     * @param array          $context
     * @return bool
     */
    public function allows(ActorInterface $actor, string $permission, array $context): bool
    {
        return $context['user'] !== $actor;
    }
}
