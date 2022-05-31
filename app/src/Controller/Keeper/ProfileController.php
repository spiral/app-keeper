<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App\Controller\Keeper;

use App\Database\User;
use App\Request\Keeper\Profile\UpdateRequest;
use App\Service\Exception\PersistException;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Domain\Annotation\Guarded;
use Spiral\Keeper\Annotation as Keeper;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Security\ActorInterface;
use Spiral\Translator\Traits\TranslatorTrait;

#[Keeper\Controller(name: 'profile')]
class ProfileController implements SingletonInterface
{
    use PrototypeTrait;
    use TranslatorTrait;

    #[Keeper\Action(route: '/me', methods: 'GET')]
    public function me(ActorInterface $actor): string
    {
        return $this->views->render('keeper/me', ['user' => $actor]);
    }

    /**
     * @param UpdateRequest $request
     * @param User          $user
     * @return array
     *
     * @throws PersistException
     */
    #[Keeper\Action(route: '/<user>/update', methods: 'POST')]
    #[Guarded(permission: 'self.update', else: 'forbidden')]
    public function update(UpdateRequest $request, User $user): array
    {
        if (!$this->passwords->compare($request->currentPassword, $user->passwordHash)) {
            return [
                'status' => 200,
                'error'  => $this->say('Account password does not match'),
            ];
        }

        $this->entities->save($request->map($user, $this->passwords));

        return [
            'status'  => 200,
            'message' => $this->say('Profile updated successfully'),
        ];
    }
}
