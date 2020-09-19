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
use Spiral\Filters\Filter;

/**
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 */
class UpdateRequest extends Filter
{
    protected const SCHEMA = [
        'email'     => 'data:email',
        'firstName' => 'data:firstName',
        'lastName'  => 'data:lastName',
    ];

    protected const VALIDATES = [
        'email'     => [
            ['notEmpty'],
            ['string'],
            ['email'],
            ['entity:unique', 'user', 'email', 'error' => '[[Email address already used.]]'],
        ],
        'firstName' => ['notEmpty', 'string'],
        'lastName'  => ['notEmpty', 'string'],
    ];

    /**
     * @param User $user
     * @return User
     */
    public function map(User $user): User
    {
        $user->firstName = $this->firstName;
        $user->lastName = $this->lastName;
        $user->email = $this->email;

        return $user;
    }
}
