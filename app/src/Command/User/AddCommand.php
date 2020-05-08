<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */

declare(strict_types=1);

namespace App\Command\User;

use App\Database\User;
use Spiral\Console\Command;
use Spiral\Prototype\Traits\PrototypeTrait;

class AddCommand extends Command
{
    use PrototypeTrait;

    protected const NAME        = 'user:add';
    protected const DESCRIPTION = 'Add Super-Admin user';

    /**
     * Perform command
     */
    protected function perform(): void
    {
        $user = new User();
        $user->firstName = 'Spiral';
        $user->lastName = 'Scout';
        $user->email = 'admin@spiralscout.com';
        $user->passwordHash = $this->passwords->hash('Password_01');
        $user->roles = 'super-admin';

        $this->entities->save($user);
    }
}
