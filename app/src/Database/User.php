<?php

declare(strict_types=1);

namespace App\Database;

use App\Mapper\TsMapper;
use App\Repository\UserRepository;
use Cycle\Annotated\Annotation as Cycle;
use App\Mapper\Traits\TsTrait;
use Spiral\Security\ActorInterface;

#[Cycle\Entity(table: 'users', repository: UserRepository::class, mapper: TsMapper::class)]
#[Cycle\Table\Index(columns: ['email'], unique: true)]
class User implements ActorInterface
{
    use TsTrait;

    #[Cycle\Column(type: 'bigPrimary')]
    public int $id;

    #[Cycle\Column(type: 'string')]
    public string $email;

    #[Cycle\Column(type: 'string', name: 'password')]
    public string $passwordHash;

    #[Cycle\Column(type: 'string', name: 'first_name')]
    public string $firstName;

    #[Cycle\Column(type: 'string', name: 'last_name')]
    public string $lastName;

    /**
     * User roles (comma separated).
     */
    #[Cycle\Column(type: 'string')]
    public string $roles;

    public function getRoles(): array
    {
        // for demo purposes only
        return \explode(',', $this->roles);
    }
}
