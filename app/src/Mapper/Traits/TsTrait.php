<?php

declare(strict_types=1);

namespace App\Mapper\Traits;

use Cycle\Annotated\Annotation\Column;

trait TsTrait
{
    #[Column(type: 'datetime', name: 'created_at', nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[Column(type: 'datetime', name: 'updated_at', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
}
