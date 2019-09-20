<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\User\Repository\Projection;

interface UserRepositoryInterface
{
    public function add(UserView $postView): void;

    public function delete(string $id): void;

    public function find(string $id): UserView;

    public function apply(): void;

    public function findOneBy(array $data): ?UserView;
}
