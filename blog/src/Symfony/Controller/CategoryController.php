<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Blog\Application\Query\Category\GetAll\GetAllCategoryQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends RestController
{
    /**
     * @Route("/category/{page}/{limit}", name="categories", methods={"GET", "POST"})
     */
    public function getAllCategoryAction(Request $request, int $page, int $limit): Response
    {
        $categories = $this->system->query(new GetAllCategoryQuery($page, $limit));

        return $this->render('category/category.html.twig', [
            'props' => ['categories' => $this->serializer->serialize($categories, 'json')],
        ]);
    }
}
