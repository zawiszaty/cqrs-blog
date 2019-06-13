<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Symfony\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends RestController
{
    /**
     * @Route("/category", name="add_category", methods={"GET", "POST"})
     */
    public function addCategoryAction(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
        }

        return $this->render('category/category.html.twig', [
            'form' => $form->createView(),
            'props' => ['movies' => [
            ]],
        ]);
    }
}
