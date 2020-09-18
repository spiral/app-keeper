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
use Spiral\Security\GuardInterface;

/**
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property array  $roles
 * @property string $password
 * @property string $confirmPassword
 */
class CreateRequest extends Filter
{
    protected const SCHEMA = [
        'firstName'       => 'data:firstName',
        'lastName'        => 'data:lastName',
        'email'           => 'data:email',
        'password'        => 'data:password',
        'confirmPassword' => 'data:confirmPassword',
        'roles'           => 'data:roles'
    ];

    protected const VALIDATES = [
        'firstName'       => ['notEmpty', 'string'],
        'lastName'        => ['notEmpty', 'string'],
        'email'           => [
            ['notEmpty'],
            ['string'],
            ['email'],
            ['entity:unique', 'user', 'email', 'error' => '[[Email address already used.]]']
        ],
        'password'        => [
            'notEmpty',
            'string',
            [[PasswordHasher::class, 'checkPassword'], 'error' => 'Password is too weak.']
        ],
        'confirmPassword' => [
            'notEmpty',
            'string',
            ['match', 'password', 'error' => 'Passwords do not match.'],
        ],
        'roles'           => [
            ['notEmpty', 'error' => 'At least one role is required.'],
            ['array'],
            [[RolesRequest::class, 'validRoles'], 'error' => 'Invalid roles.']
        ]
    ];

    /**
     * @param User           $user
     * @param GuardInterface $guard
     * @param PasswordHasher $passwords
     * @return User
     */
    public function map(User $user, GuardInterface $guard, PasswordHasher $passwords): User
    {
        $user->firstName = $this->firstName;
        $user->lastName = $this->lastName;
        $user->email = $this->email;
        $user->passwordHash = $passwords->hash($this->password);

        if ($guard->allows('users.roles', compact('user'))) {
            $user->roles = join(',', $this->roles);
        } else {
            $user->roles = 'user';
        }

        return $user;
    }
}
