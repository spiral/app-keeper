<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Repository;

use App\Database\User;
use Cycle\ORM\Select\Repository;
use Spiral\Auth\ActorProviderInterface;
use Spiral\Auth\TokenInterface;

class UserRepository extends Repository implements ActorProviderInterface
{
    /**
     * @param string $username
     * @return User|null
     */
    public function findByUsername(string $username): ?User
    {
        return $this->findOne(['email' => $username]);
    }

    /**
     * @param TokenInterface $token
     * @return object|null
     */
    public function getActor(TokenInterface $token): ?object
    {
        $data = $token->getPayload();

        if (!isset($data['userID'])) {
            return null;
        }

        return $this->findOne(['id' => $data['userID']]);
    }
}
