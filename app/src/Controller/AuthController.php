<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\Auth\LoginRequest;
use App\Request\Auth\LogoutRequest;
use Psr\Http\Message\ResponseInterface;
use Spiral\Http\Exception\ClientException\BadRequestException;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

/**
 * User authentication and authorization.
 */
class AuthController
{
    use PrototypeTrait;

    #[Route(route: '/login', name: 'auth:login')]
    public function login(LoginRequest $request): array
    {
        $user = $this->users->findByUsername($request->getUsername());
        if ($user === null || !$this->passwords->compare($request->getPassword(), $user->passwordHash)) {
            return [
                'status' => 400,
                'error'  => 'No such user',
            ];
        }

        $token = $this->authTokens->create(
            ['userID' => $user->id],
            $request->getSessionExpiration()
        );

        $this->auth->start($token);

        return [
            'status'  => 200,
            'message' => 'Authenticated, redirecting',
            'action'  => 'reload',
        ];
    }

    #[Route(route: '/logout', name: 'auth:logout')]
    public function logout(LogoutRequest $logout): ResponseInterface
    {
        if ($this->auth->getToken() === null || $this->auth->getToken()->getID() !== $logout->getToken()) {
            throw new BadRequestException();
        }

        $this->auth->close();

        return $this->response->redirect('/');
    }
}
