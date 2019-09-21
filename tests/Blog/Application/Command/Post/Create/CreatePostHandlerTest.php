<?php

declare(strict_types=1);

namespace Tests\Blog\Application\Command\Post\Create;

use App\Blog\Application\Command\Post\Create\CreatePostCommand;
use App\Blog\Domain\Post\Event\PostWasCreatedEvent;
use App\Blog\Infrastructure\Post\Repository\Projection\PostRepository;
use App\Blog\Infrastructure\Post\Repository\Store\PostStoreRepository;
use Tests\Blog\Application\ApplicationTestCase;

class CreatePostHandlerTest extends ApplicationTestCase
{
    /**
     * @dataProvider passwordDataProvider
     */
    public function test_it_handle_method(string $title, string $content, array $tags)
    {
        $this->assertNull($this->system->command(new CreatePostCommand($title, $content, $tags)));
        /** @var PostStoreRepository $repository */
        $repository = self::$container->get(PostStoreRepository::class);
        $event = $repository->getEvents()[0];
        $this->assertInstanceOf(PostWasCreatedEvent::class, $event);
        /** @var PostRepository $postRepository */
        $postRepository = self::$container->get(PostRepository::class);
        $result = $postRepository->findOneBy(['title' => $title]);
        $this->assertNotNull($result);
        $this->assertSame($title, $result->getTitle());
        $this->assertSame($content, $result->getContent());
        $this->assertSame(json_encode($tags), $result->getTags());
    }

    public function passwordDataProvider()
    {
        return [
            ['test', 'test', ['test', 'test2']],
        ];
    }
}
