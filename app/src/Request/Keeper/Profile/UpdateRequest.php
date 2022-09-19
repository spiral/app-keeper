<?php

declare(strict_types=1);

namespace App\Request\Keeper\Profile;

use App\Database\User;
use App\Security\PasswordHasher;
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

    #[Post]
    #[Setter('strval')]
    public readonly string $currentPassword;

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

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'firstName' => ['string', 'required'],
            'lastName' => ['string', 'required'],
            'email' => [
                'string',
                'required',
                'email',
                ['entity:unique', 'user', 'email', 'error' => '[[Email address already used.]]']],
            'password' => [
                'string',
                [
                    [PasswordHasher::class, 'checkPassword'],
                    'error' => '[[Password is too weak.]]',
                    'if'    => ['withAll' => ['password']],
                ],
            ],
            'confirmPassword' => [
                'string',
                ['required', 'if' => ['withAll' => ['password']]],
                ['match', 'password', 'error' => '[[Passwords do not match.]]'],
            ],
            'currentPassword' => ['string', 'required'],
        ]);
    }
}
