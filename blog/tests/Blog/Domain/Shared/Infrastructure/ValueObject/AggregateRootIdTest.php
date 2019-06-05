<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\Shared\Infrastructure\ValueObject;

use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class AggregateRootIdTest extends TestCase
{
    public function test_it_create_from_string_and_return_valid_uuid()
    {
        $id = Uuid::uuid4()->toString();
        $aggregateRootId = AggregateRootId::withId(RamseyUuidAdapter::fromString($id));
        $this->assertSame($aggregateRootId->toString(), $id);
    }
}
