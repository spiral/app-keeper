<?php

declare(strict_types=1);

namespace App\Mapper;

use Cycle\ORM\Command\CommandInterface;
use Cycle\ORM\Command\Database\Update;
use Cycle\ORM\Heap\Node;
use Cycle\ORM\Heap\State;
use Cycle\ORM\Mapper\Mapper as BaseMapper;

class TsMapper extends BaseMapper
{
    public function queueCreate(object $entity, Node $node, State $state): CommandInterface
    {
        $cmd = parent::queueCreate($entity, $node, $state);

        $state->register('createdAt', new \DateTimeImmutable());
        $cmd->register('created_at', new \DateTimeImmutable());

        $state->register('updatedAt', new \DateTimeImmutable());
        $cmd->register('updated_at', new \DateTimeImmutable());

        return $cmd;
    }

    public function queueUpdate(object $entity, Node $node, State $state): CommandInterface
    {
        /** @var Update $cmd */
        $cmd = parent::queueUpdate($entity, $node, $state);

        $state->register('updatedAt', new \DateTimeImmutable());
        $cmd->registerAppendix('updated_at', new \DateTimeImmutable());

        return $cmd;
    }
}
