<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Blog\Application\Command\Category\Create\CreateCategoryCommand;
use App\Blog\Application\Query\Category\GetAll\GetAllCategoryQuery;
use App\Blog\System;
use App\Symfony\DTO\CategoryDTO;
use App\Symfony\Form\CategoryType;
use Limenius\Liform\Liform;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CategoryController extends RestController
{
    /**
     * @var Liform
     */
    private $liform;

    public function __construct(System $system, SerializerInterface $serializer, Liform $liform)
    {
        parent::__construct($system, $serializer);
        $this->liform = $liform;
    }

    /**
     * @Route("/category/{page}/{limit}", name="categories", methods={"GET"}, defaults={"page": 1, "limit": 10}, requirements={"page"="\d+", "limit"="\d+"})
     */
    public function getAllCategoryAction(Request $request, int $page, int $limit): Response
    {
        $categories = $this->system->query(new GetAllCategoryQuery($page, $limit));

        return $this->render('category/category.html.twig', [
            'props' => ['categories' => $this->serializer->serialize($categories, 'json')],
            'initialState' => [],
        ]);
    }

    /**
     * @Route("/category/create", name="create_cateogry", methods={"GET", "POST"})
     */
    public function createCategory(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->system->command(new CreateCategoryCommand($data['name']));
            $this->addFlash('info', 'Success create category');

            return $this->redirectToRoute('categories');
        }

        return $this->render('category/create_category.html.twig', [
            'props' => [
                'schema' => $this->liform->transform($form),
            ],
            'initialState' => [],
        ]);
    }

    /**
     * @ParamConverter(
     *     "category",
     *     options={"mapping_by": {"id": "id"}},
     *     converter="entity-to-dto-converter",
     *     class="App\Blog\Infrastructure\Category\Repository\Projection\CategoryView"
     * )
     * @Route("/category/edit/{id}", name="edit_cateogry", methods={"GET", "POST"})
     */
    public function editCategory(CategoryDTO $category, Request $request, string $id): Response
    {
        dd($category);

        return new JsonResponse('test');
    }
}
