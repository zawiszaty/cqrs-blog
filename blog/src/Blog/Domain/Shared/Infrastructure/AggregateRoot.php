<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

class AggregateRoot
{
    /**
     * @var AggregateRootId
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
