<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Processor;

use App\Blog\Domain\Category\Events\CategoryWasCreatedEvent;
use App\Blog\Domain\Category\Events\CategoryWasDeletedEvent;
use App\Blog\Domain\Category\Events\CategoryWasEditedEvent;
use App\Blog\Domain\Post\Event\PostWasCreatedEvent;
use App\Blog\Domain\User\Events\UserWasCreatedEvent;
use App\Blog\Infrastructure\Category\Repository\Projection\MysqlCategoryProjection;
use App\Blog\Infrastructure\Post\Repository\Projection\MysqlPostProjection;
use App\Blog\Infrastructure\User\Repository\Projection\MysqlUserProjection;

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
            CategoryWasEditedEvent::class => MysqlCategoryProjection::class.':edit',
            CategoryWasDeletedEvent::class => MysqlCategoryProjection::class.':delete',
            UserWasCreatedEvent::class => MysqlUserProjection::class.':create',
            PostWasCreatedEvent::class => MysqlPostProjection::class.':create',
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
