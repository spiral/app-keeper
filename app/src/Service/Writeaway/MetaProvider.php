<?php

declare(strict_types=1);

namespace App\Service\Writeaway;

use App\Database\User;
use Spiral\Security\ActorInterface;
use Spiral\Writeaway\DTO\Meta;
use Spiral\Writeaway\MetaProviderInterface;
use Spiral\Writeaway\Service\NullMetaProvider;

class MetaProvider implements MetaProviderInterface
{
    public function __construct(
        private ActorInterface $actor,
        private NullMetaProvider $null
    ) {
    }

    public function provide(): Meta
    {
        if ($this->actor instanceof User) {
            return new Meta((string)$this->actor->id, "{$this->actor->firstName} {$this->actor->lastName})");
        }

        return $this->null->provide();
    }
}
