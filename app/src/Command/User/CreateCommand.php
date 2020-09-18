<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Command\User;

use App\Database\User;
use Spiral\Console\Command;
use Spiral\Prototype\Traits\PrototypeTrait;
use Symfony\Component\Console\Input\InputArgument;

class CreateCommand extends Command
{
    use PrototypeTrait;

    protected const NAME        = 'user:create';
    protected const DESCRIPTION = 'Create Super-Admin user';
    protected const ARGUMENTS   = [
        ['firstName', InputArgument::REQUIRED, 'First name'],
        ['lastName', InputArgument::REQUIRED, 'Last name'],
        ['email', InputArgument::REQUIRED, 'Email/Username'],
        ['password', InputArgument::REQUIRED, 'Password'],
    ];

    /**
     * Perform command
     */
    protected function perform(): void
    {
        $user = new User();
        $user->firstName = $this->argument('firstName');
        $user->lastName = $this->argument('lastName');
        $user->email = $this->argument('email');
        $user->passwordHash = $this->passwords->hash($this->argument('password'));
        $user->roles = 'super-admin';

        $this->entities->save($user);
    }
}
