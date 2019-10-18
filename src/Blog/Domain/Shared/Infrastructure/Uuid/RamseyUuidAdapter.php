<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure\Uuid;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface as RanseyUuid;

class RamseyUuidAdapter implements UuidInterface
{
    /**
     * @var RanseyUuid
     */
    private $id;

    private function __construct(RanseyUuid $id)
    {
        $this->id = $id;
    }

    public static function generate(): UuidInterface
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $id): UuidInterface
    {
        return new self(Uuid::fromString($id));
    }

    public function toString(): string
    {
        return $this->id->toString();
    }
}
