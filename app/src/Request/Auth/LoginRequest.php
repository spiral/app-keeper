<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Request\Auth;

use Spiral\Filters\Filter;

class LoginRequest extends Filter
{
    protected const SCHEMA = [
        'username' => 'data:username',
        'password' => 'data:password',
        'code'     => 'data:code',
        'remember' => 'data:remember',
    ];

    protected const VALIDATES = [
        'username' => ['notEmpty', 'string'],
        'password' => ['notEmpty', 'string'],
        'remember' => ['boolean'],
        'code'     => ['string'],
    ];

    protected const SETTERS = [
        'username' => 'strval',
        'password' => 'strval',
        'code'     => 'strval',
        'remember' => 'boolval',
    ];

    /**
     * @see https://en.wikipedia.org/wiki/ISO_8601#Durations
     */
    private const DEFAULT_DURATION  = 'P1D';
    private const REMEMBER_DURATION = 'P1M';

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->getField('username');
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->getField('password');
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        if ($this->getField('code') === '') {
            return null;
        }

        return $this->getField('code');
    }

    /**
     * @return \DateTimeInterface
     */
    public function getSessionExpiration(): \DateTimeInterface
    {
        $now = new \DateTime();

        if ((bool) $this->getField('rememberMe')) {
            return $now->add(new \DateInterval(self::REMEMBER_DURATION));
        }

        return $now->add(new \DateInterval(self::DEFAULT_DURATION));
    }
}
