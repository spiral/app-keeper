<?php

declare(strict_types=1);

namespace App\Request\Keeper\User;

use App\Database\User;
use App\Security\PasswordHasher;
use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Attribute\NestedFilter;
use Spiral\Filters\Attribute\Setter;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Security\GuardInterface;
use Spiral\Validator\FilterDefinition;

class CreateRequest extends Filter implements HasFilterDefinition
{
    #[Post]
    #[Setter('strval')]
    public readonly string $firstName;

    #[Post]
    #[Setter('strval')]
    public readonly string $lastName;

    #[Post]
    #[Setter('strval')]
    public readonly string $email;

    #[Post]
    #[Setter('strval')]
    public readonly string $password;

    #[Post]
    #[Setter('strval')]
    public readonly string $confirmPassword;

    #[NestedFilter(class: RolesRequest::class)]
    public readonly RolesRequest $roles;

    public function map(User $user, GuardInterface $guard, PasswordHasher $passwords): User
    {
        $user->firstName = $this->firstName;
        $user->lastName = $this->lastName;
        $user->email = $this->email;
        $user->passwordHash = $passwords->hash($this->password);

        if ($guard->allows('users.roles', compact('user'))) {
            $user = $this->roles->map($user);
        } else {
            $user->roles = 'user';
        }

        return $user;
    }

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'firstName' => ['string', 'required'],
            'lastName' => ['string', 'required'],
            'email' => [
                'string',
                'required',
                'email',
                ['entity:unique', 'user', 'email', 'error' => '[[Email address already used.]]'],
            ],
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
