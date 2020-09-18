<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Request\Keeper\Profile;

use App\Database\User;
use App\Security\PasswordHasher;
use Spiral\Filters\Filter;

/**
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property string $confirmPassword
 * @property string $currentPassword
 */
class UpdateRequest extends Filter
{
    protected const SCHEMA = [
        'firstName'       => 'data:firstName',
        'lastName'        => 'data:lastName',
        'email'           => 'data:email',
        'password'        => 'data:password',
        'confirmPassword' => 'data:confirmPassword',
        'currentPassword' => 'data:currentPassword',
    ];

    protected const VALIDATES = [
        'firstName'       => ['notEmpty', 'string'],
        'lastName'        => ['notEmpty', 'string'],
        'email'           => [
            ['notEmpty'],
            ['string'],
            ['email'],
            ['entity:unique', 'user', 'email', 'error' => 'Email address already used.']
        ],
        'password'        => [
            ['string'],
            [
                [PasswordHasher::class, 'checkPassword'],
                'error' => 'Password is too weak.',
                'if'    => ['withAll' => ['password']]
            ]
        ],
        'confirmPassword' => [
            'string',
            ['notEmpty', 'if' => ['withAll' => ['password']]],
            ['match', 'password', 'error' => 'Passwords do not match.'],
        ],
        'currentPassword' => ['notEmpty', 'string'],
    ];

    protected const SETTERS = [
        'firstName'       => 'strval',
        'lastName'        => 'strval',
        'email'           => 'strval',
        'password'        => 'strval',
        'confirmPassword' => 'strval',
        'currentPassword' => 'strval',
    ];

    /**
     * @param User           $user
     * @param PasswordHasher $passwordManager
     * @return User
     */
    public function map(User $user, PasswordHasher $passwordManager): User
    {
        $user->firstName = $this->firstName;
        $user->lastName = $this->lastName;
        $user->email = $this->email;

        if ($this->password !== '') {
            $user->passwordHash = $passwordManager->hash($this->password);
        }

        return $user;
    }
}
