<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Processor;

use App\Blog\Domain\Category\Events\CategoryWasCreatedEvent;
use App\Blog\Infrastructure\Category\Repository\Projection\MysqlCategoryProjection;

class ProcessorConfig
{
    /**
     * @var array
     */
    private $config = [];

    public function __construct()
    {
        $this->config = [
            CategoryWasCreatedEvent::class => MysqlCategoryProjection::class.':create',
        ];
    }

    /**
     * @return string
     */
    public function getConfig(string $key): string
    {
        return $this->config[$key];
    }
}
