<?php

declare(strict_types=1);

namespace App\Request\Keeper\User;

use App\Database\User;
use App\Security\PasswordHasher;
use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Attribute\Setter;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;

class UpdatePasswordRequest extends Filter implements HasFilterDefinition
{
    #[Post]
    #[Setter('strval')]
    public readonly string $password;

    #[Post]
    #[Setter('strval')]
    public readonly string $confirmPassword;

    public function map(User $user, PasswordHasher $passwordManager): User
    {
        $user->passwordHash = $passwordManager->hash($this->password);

        return $user;
    }

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'password' => [
                'required',
                'string',
                [[PasswordHasher::class, 'checkPassword'], 'error' => '[[Password is too weak.]]'],
            ],
            'confirmPassword' => [
                'string',
                'required',
                ['match', 'password', 'error' => '[[Passwords do not match.]]'],
            ],
        ]);
    }
}
