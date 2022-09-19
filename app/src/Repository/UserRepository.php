<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\User;
use Cycle\ORM\Select\Repository;
use Spiral\Auth\ActorProviderInterface;
use Spiral\Auth\TokenInterface;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped(property: 'users')]
class UserRepository extends Repository implements ActorProviderInterface
{
    public function findByUsername(string $username): ?User
    {
        return $this->findOne(['email' => $username]);
    }

    public function getActor(TokenInterface $token): ?User
    {
        $data = $token->getPayload();

        if (!isset($data['userID'])) {
            return null;
        }

        return $this->findOne(['id' => $data['userID']]);
    }
}
