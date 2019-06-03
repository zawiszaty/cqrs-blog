<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\StoreRepository;

use App\Blog\Domain\Shared\Infrastructure\AggregateRoot;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class InMemoryStoreRepository
{
    protected $objects = [];

    protected function apply(AggregateRoot $object)
    {
        $this->objects[$object->getId()] = $object;
    }

    public function get(string $id): object
    {
        $object = $this->objects[$id];

        if (!$object) {
            throw new NotFoundHttpException();
        }

        return $object;
    }

    public function getAll()
    {
        return $this->objects;
    }
}
