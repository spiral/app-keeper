<?php

declare(strict_types=1);

namespace App\Request\Keeper\User;

use App\Database\User;
use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Attribute\Setter;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;

class UpdateRequest extends Filter implements HasFilterDefinition
{
    #[Post]
    #[Setter('strval')]
    public readonly string $email;

    #[Post]
    #[Setter('strval')]
    public readonly string $firstName;

    #[Post]
    #[Setter('strval')]
    public readonly string $lastName;

    public function map(User $user): User
    {
        $user->firstName = $this->firstName;
        $user->lastName = $this->lastName;
        $user->email = $this->email;

        return $user;
    }

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'email' => [
                'string',
                'required',
                'email',
                ['entity:unique', 'user', 'email', 'error' => '[[Email address already used.]]'],
            ],
            'firstName' => ['string', 'required'],
            'lastName' => ['string', 'required'],
        ]);
    }
}
