<?php

declare(strict_types=1);

namespace App\Blog\Application;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Collection.
 */
class Collection
{
    /**
     * @var int
     */
    public $page;
    /**
     * @var int
     */
    public $limit;
    /**
     * @var int
     */
    public $total;
    /**
     * @var mixed
     */
    public $data;

    /**
     * Collection constructor.
     *
     * @param int        $page
     * @param int        $limit
     * @param int        $total
     * @param array|null $data
     */
    public function __construct(int $page, int $limit, int $total, ?array $data)
    {
        $this->exists($page, $limit, $total);
        $this->page = $page;
        $this->limit = $limit;
        $this->total = $total;
        $this->data = $data;
    }

    private function exists(int $page, int $limit, int $total): void
    {
        if (($limit * ($page - 1)) >= $total) {
            throw new NotFoundHttpException();
        }
    }
}
