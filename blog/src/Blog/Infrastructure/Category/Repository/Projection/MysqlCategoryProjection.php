<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Domain\Category\Events\CategoryWasCreatedEvent;
use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;

class MysqlCategoryProjection
{
    /**
     * @var ORMAdapterInterface
     */
    private $ORMAdapter;

    public function __construct(ORMAdapterInterface $ORMAdapter)
    {
        $this->ORMAdapter = $ORMAdapter;
    }

    public function create(CategoryWasCreatedEvent $event): void
    {
        $categoryView = new CategoryView(
            $event->getId()->toString(),
            $event->getName()->toString()
        );
        $this->ORMAdapter->persist($categoryView);
        $this->ORMAdapter->flush();
    }
}
