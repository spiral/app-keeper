<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Request\Keeper\User;

use App\Database\User;
use App\Security\PasswordHasher;
use Spiral\Filters\Filter;

/**
 * @property string $password
 * @property string $confirmPassword
 */
class UpdatePasswordRequest extends Filter
{
    protected const SCHEMA = [
        'password'        => 'data:password',
        'confirmPassword' => 'data:confirmPassword',
    ];

    protected const VALIDATES = [
        'password'        => [
            'notEmpty',
            'string',
            [[PasswordHasher::class, 'checkPassword'], 'error' => 'Password is too weak.'],
        ],
        'confirmPassword' => [
            'notEmpty',
            'string',
            ['match', 'password', 'error' => 'Passwords do not match.'],
        ],
    ];

    /**
     * @param User           $user
     * @param PasswordHasher $passwordManager
     * @return User
     */
    public function map(User $user, PasswordHasher $passwordManager): User
    {
        $user->passwordHash = $passwordManager->hash($this->password);

        return $user;
    }
}
