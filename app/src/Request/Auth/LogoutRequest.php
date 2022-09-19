<?php

declare(strict_types=1);

namespace App\Request\Auth;

use Spiral\Filters\Attribute\Input\Input;
use Spiral\Filters\Attribute\Setter;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;

class LogoutRequest extends Filter implements HasFilterDefinition
{
    #[Input]
    #[Setter('strval')]
    public readonly string $token;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'token' => ['string', 'required'],
        ]);
    }
}
