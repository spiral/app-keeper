<?php

declare(strict_types=1);

namespace App\Security;

use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped(property: 'passwords')]
class PasswordHasher implements SingletonInterface
{
    public function compare(string $password, string $hash): bool
    {
        return \password_verify($password, $hash);
    }

    public function hash(string $password): string
    {
        return \password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @see https://stackoverflow.com/questions/10752862/password-strength-check-in-php
     */
    public static function checkPassword(string $password): bool
    {
        $errors = [];

        if (\strlen($password) < 8) {
            $errors[] = 'Password too short!';
        }

        if (!\preg_match('#[0-9]+#', $password)) {
            $errors[] = 'Password must include at least one number!';
        }

        if (!\preg_match('#[a-zA-Z]+#', $password)) {
            $errors[] = 'Password must include at least one letter!';
        }

        return $errors === [];
    }
}
