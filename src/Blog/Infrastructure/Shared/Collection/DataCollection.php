<?php
declare(strict_types=1);


namespace App\Blog\Infrastructure\Shared\Collection;


final class DataCollection
{
    /** @var array */
    private $data;

    /** @var int */
    private $count;

    public function __construct(array $data, int $count)
    {
        $this->data  = $data;
        $this->count = $count;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}