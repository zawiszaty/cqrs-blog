<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post\Exception;

use App\Blog\Domain\Shared\Exception\DomainException;

final class PostException extends DomainException
{
    public static function fromMissingPost(string $id): self
    {
        return new self("Post with id: $id doesnt exist");
    }
}
