<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Post\Create;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Post\Post;
use App\Blog\Domain\Post\PostStoreRepositoryInterface;

final class CreatePostHandler implements CommandHandlerInterface
{
    /**
     * @var PostStoreRepositoryInterface
     */
    private $postStoreRepository;

    public function __construct(PostStoreRepositoryInterface $postStoreRepository)
    {
        $this->postStoreRepository = $postStoreRepository;
    }

    public function __invoke(CreatePostCommand $createPostCommand)
    {
        $post = Post::create(
            $createPostCommand->getTitle(),
            $createPostCommand->getContent(),
            $createPostCommand->getTags(),
            );
        $this->postStoreRepository->store($post);
    }
}
