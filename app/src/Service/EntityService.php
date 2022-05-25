<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Exception\PersistException;
use Cycle\ORM\EntityManagerInterface;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped(property: 'entities')]
class EntityService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function save(object $entity): void
    {
        $this->entityManager->persist($entity);

        try {
            $this->entityManager->run();
        } catch (\Throwable $e) {
            throw new PersistException('Unable to persist entity', $e->getCode(), $e);
        }
    }

    public function delete(object $entity): void
    {
        $this->entityManager->delete($entity);

        try {
            $this->entityManager->run();
        } catch (\Throwable $e) {
            throw new PersistException('Unable to persist entity', $e->getCode(), $e);
        }
    }
}
