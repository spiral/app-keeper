<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Mapper;

use Cycle\Annotated\Annotation as Cycle;
use Cycle\ORM\Command\ContextCarrierInterface;
use Cycle\ORM\Command\Database\Update;
use Cycle\ORM\Heap\Node;
use Cycle\ORM\Heap\State;
use Cycle\ORM\Mapper\Mapper as BaseMapper;

/**
 * @Cycle\Table(
 *      columns={
 *          "createdAt": @Cycle\Column(type="datetime", name="created_at"),
 *          "updatedAt": @Cycle\Column(type="datetime", name="updated_at")
 *      }
 * )
 */
class TsMapper extends BaseMapper
{
    /**
     * @inheritDoc
     */
    public function queueCreate($entity, Node $node, State $state): ContextCarrierInterface
    {
        $cmd = parent::queueCreate($entity, $node, $state);

        $state->register('createdAt', new \DateTimeImmutable(), true);
        $cmd->register('created_at', new \DateTimeImmutable(), true);

        $state->register('updatedAt', new \DateTimeImmutable(), true);
        $cmd->register('updated_at', new \DateTimeImmutable(), true);

        return $cmd;
    }

    /**
     * @inheritDoc
     */
    public function queueUpdate($entity, Node $node, State $state): ContextCarrierInterface
    {
        /** @var Update $cmd */
        $cmd = parent::queueUpdate($entity, $node, $state);

        $state->register('updatedAt', new \DateTimeImmutable(), true);
        $cmd->registerAppendix('updated_at', new \DateTimeImmutable());

        return $cmd;
    }
}
