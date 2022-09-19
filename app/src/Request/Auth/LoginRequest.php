<?php

declare(strict_types=1);

namespace App\Request\Auth;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Attribute\Setter;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;

class LoginRequest extends Filter implements HasFilterDefinition
{
    /**
     * @see https://en.wikipedia.org/wiki/ISO_8601#Durations
     */
    private const DEFAULT_DURATION  = 'P1D';
    private const REMEMBER_DURATION = 'P1M';

    #[Post]
    #[Setter('strval')]
    public readonly string $username;

    #[Post]
    #[Setter('strval')]
    public readonly string $password;

    #[Post]
    #[Setter('strval')]
    private readonly string $code;

    #[Post]
    #[Setter('boolval')]
    public bool $remember = false;

    public function getCode(): ?string
    {
        if ($this->code === '') {
            return null;
        }

        return $this->code;
    }

    public function getSessionExpiration(): \DateTimeInterface
    {
        $now = new \DateTime();

        if ($this->remember) {
            return $now->add(new \DateInterval(self::REMEMBER_DURATION));
        }

        return $now->add(new \DateInterval(self::DEFAULT_DURATION));
    }

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'username' => ['string', 'required'],
            'password' => ['string', 'required'],
            'code' => ['string']
        ]);
    }
}
