<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Post\Repository\Store;

use App\Blog\Domain\Post\Exception\PostException;
use App\Blog\Domain\Post\Post;
use App\Blog\Domain\Post\PostStoreRepositoryInterface;
use App\Blog\Domain\Post\ValueObject\Content;
use App\Blog\Domain\Post\ValueObject\Tags\Tags;
use App\Blog\Domain\Post\ValueObject\Title;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Infrastructure\Post\Repository\PostRepositoryInterface;
use App\Blog\Infrastructure\Post\Repository\Projection\PostView;
use App\Blog\Infrastructure\Shared\Processor\ProjectionProcessorInterface;
use App\Blog\Infrastructure\Shared\Rabbitmq\RabbitmqClientInterface;
use App\Blog\Infrastructure\Shared\StoreRepository\StoreRepository;

final class PostStoreRepository extends StoreRepository implements PostStoreRepositoryInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(ProjectionProcessorInterface $projectionProcessor, PostRepositoryInterface $postRepository, RabbitmqClientInterface $client)
    {
        parent::__construct($projectionProcessor, $client);
        $this->postRepository = $postRepository;
    }

    public function find(AggregateRootId $id): Post
    {
        /** @var PostView|null $postView */
        $postView = $this->postRepository->find($id);

        if (!$postView) {
            throw PostException::fromMissingPost($id->toString());
        }
        $post = Post::withData([
            'id' => AggregateRootId::withId(RamseyUuidAdapter::fromString($postView->id)),
            'content' => Content::withContent($postView->getContent()),
            'title' => Title::withTitle($postView->getTitle()),
            'tags' => Tags::withTags((array) json_decode($postView->getTags(), true, 512, JSON_THROW_ON_ERROR)),
        ]);

        return $post;
    }

    public function store(Post $post): void
    {
        foreach ($post->getUnCommittedEvent() as $event) {
            $this->events[] = $event;
        }
        $this->apply();
    }
}
