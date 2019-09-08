<?php

declare(strict_types=1);

namespace App\Blog\Domain\User;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

interface UserStoreRepositoryInterface
{
    public function find(AggregateRootId $id): User;

    public function apply(): void;

    public function store(User $category): void;
}
