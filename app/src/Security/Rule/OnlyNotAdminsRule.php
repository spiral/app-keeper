<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App\Security\Rule;

use Spiral\Security\Rule\CompositeRule;

class OnlyNotAdminsRule extends CompositeRule
{
    protected const RULES = [
        NotSelfOrOtherAdminRule::class,
        NotSelfRule::class
    ];
}
