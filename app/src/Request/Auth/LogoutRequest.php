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

class LogoutRequest extends Filter
{
    protected const SCHEMA = [
        'token' => 'query:token',
    ];

    protected const VALIDATES = [
        'token' => ['notEmpty', 'string'],
    ];

    protected const SETTERS = [
        'token' => 'strval',
    ];

    /**
     * @return string
     */
    public function getToken(): string
    {
        return (string) $this->getField('token');
    }
}
