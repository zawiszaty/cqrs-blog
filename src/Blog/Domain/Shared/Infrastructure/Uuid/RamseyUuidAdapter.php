<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure\Uuid;

use Ramsey\Uuid\Uuid;

class RamseyUuidAdapter implements UuidInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * RamseyUuidAdapter constructor.
     *
     * @param \Ramsey\Uuid\UuidInterface $id
     */
    private function __construct(\Ramsey\Uuid\UuidInterface $id)
    {
        $this->id = $id;
    }

    public static function generate(): UuidInterface
    {
        $adapter = new self(Uuid::uuid4());

        return $adapter;
    }

    public static function fromString(string $id): UuidInterface
    {
        $adapter = new self(Uuid::fromString($id));

        return $adapter;
    }

    public function toString(): string
    {
        return $this->id->toString();
    }
}
