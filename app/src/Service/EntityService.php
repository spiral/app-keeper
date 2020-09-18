<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Service;

use App\Service\Exception\PersistException;
use Cycle\ORM\TransactionInterface;
use Spiral\Prototype\Annotation\Prototyped;

/**
 * @Prototyped(property="entities")
 */
class EntityService
{
    /** @var TransactionInterface */
    private $transaction;

    /**
     * @param TransactionInterface $transaction
     */
    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @param object $entity
     * @throws PersistException
     */
    public function save($entity): void
    {
        $this->transaction->persist($entity);

        try {
            $this->transaction->run();
        } catch (\Throwable $e) {
            throw new PersistException('Unable to persist entity', $e->getCode(), $e);
        }
    }

    /**
     * @param object $entity
     * @throws PersistException
     */
    public function delete($entity): void
    {
        $this->transaction->delete($entity);

        try {
            $this->transaction->run();
        } catch (\Throwable $e) {
            throw new PersistException('Unable to persist entity', $e->getCode(), $e);
        }
    }
}
