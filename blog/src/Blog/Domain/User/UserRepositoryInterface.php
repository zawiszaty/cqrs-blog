<?php

declare(strict_types=1);

namespace App\Blog\Domain\User;

interface UserRepositoryInterface
{
    public function add(User $postView): void;

    public function delete(string $id): void;

    public function find(string $id): User;

    public function apply(): void;
}
