<?php

declare(strict_types=1);

namespace App\Security\Rule;

use Spiral\Core\Container\SingletonInterface;
use Spiral\Security\ActorInterface;
use Spiral\Security\RuleInterface;

class NotSelfOrOtherAdminRule implements RuleInterface, SingletonInterface
{
    public function allows(ActorInterface $actor, string $permission, array $context): bool
    {
        $roles = $context['user']->getRoles();

        return !(\in_array('admin', $roles, true) || \in_array('super-admin', $roles, true));
    }
}
