<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Database;

use Cycle\Annotated\Annotation as Cycle;
use App\Mapper\Traits\TsTrait;
use Spiral\Security\ActorInterface;

/**
 * @Cycle\Entity(table="users", repository="App\Repository\UserRepository", mapper="App\Mapper\TsMapper")
 * @Cycle\Table(
 *     indexes={
 *          @Cycle\Table\Index(columns={"email"}, unique=true)
 *     }
 * )
 */
class User implements ActorInterface
{
    use TsTrait;

    /**
     * @Cycle\Column(type = "bigPrimary")
     */
    public $id;

    /**
     * @Cycle\Column(type = "string")
     */
    public $email;

    /**
     * @Cycle\Column(type = "string", name="password")
     */
    public $passwordHash;

    /**
     * @Cycle\Column(type = "string", name = "first_name")
     */
    public $firstName;

    /**
     * @Cycle\Column(type = "string", name = "last_name")
     */
    public $lastName;

    /**
     * User roles (comma separated).
     *
     * @Cycle\Column(type = "string", name = "roles")
     */
    public $roles;

    /**
     * @return array
     */
    public function getRoles(): array
    {
        // for demo purposes only
        return explode(',', $this->roles);
    }
}
