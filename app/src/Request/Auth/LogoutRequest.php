<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
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
     * @return bool
     */
    public function getToken(): string
    {
        return (string) $this->getField('token');
    }
}
