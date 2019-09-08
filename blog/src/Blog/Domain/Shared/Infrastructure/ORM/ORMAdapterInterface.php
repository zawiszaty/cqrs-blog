<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure\ORM;

interface ORMAdapterInterface
{
    public function getRepository(string $model): object;

    public function persist(object $model): void;

    public function flush(): void;

    public function remove(object $model): void;
}
