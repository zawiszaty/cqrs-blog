<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Blog\Application\Command\Post\Create\CreatePostCommand;
use App\Blog\Application\Query\Post\GetAll\GetAllPostQuery;
use App\Symfony\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PostController extends WebController
{
    /**
     * @Route("/posts/{page}/{limit}", name="posts", methods={"GET"}, defaults={"page": 1, "limit": 10}, requirements={"page"="\d+", "limit"="\d+"})
     */
    public function getAllCategoryAction(Request $request, int $page, int $limit): Response
    {
        $posts = $this->system->query(new GetAllPostQuery($page, $limit));

        return $this->render('post/post.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/post/create", name="post_cateogry_form", methods={"GET", "POST"})
     */
    public function createCategoryForm(Request $request): Response
    {
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->system->command(new CreatePostCommand(
                $data['title'],
                $data['content'],
                explode(',', $data['tags'])
            ));
            $this->addFlash('info', 'Success create post');

            return $this->redirectToRoute('home');
        }

        return $this->render('post/create_post.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(),
        ]);
    }
}
