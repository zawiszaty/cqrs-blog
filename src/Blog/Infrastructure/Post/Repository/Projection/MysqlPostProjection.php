<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Post\Repository\Projection;

use App\Blog\Domain\Post\Event\PostWasCreatedEvent;
use App\Blog\Infrastructure\Post\Repository\PostRepositoryInterface;
use App\Blog\Infrastructure\Shared\Slugger\Slugger;

final class MysqlPostProjection
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;
    /**
     * @var Slugger
     */
    private $slugger;

    public function __construct(PostRepositoryInterface $postRepository, Slugger $slugger)
    {
        $this->postRepository = $postRepository;
        $this->slugger = $slugger;
    }

    public function create(PostWasCreatedEvent $event): void
    {
        $postView = new PostView(
            $event->getId()->toString(),
            $event->getTitle()->toString(),
            $event->getContent()->toString(),
            $this->slugger->slugify($event->getTitle()->toString()),
            $event->getTags()->toString()
        );
        $this->postRepository->store($postView);
    }
}
