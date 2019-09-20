<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Blog\Application\Command\Category\Create\CreateCategoryCommand;
use App\Blog\Application\Command\Category\Delete\DeleteCategoryCommand;
use App\Blog\Application\Command\Category\Edit\EditCategoryCommand;
use App\Blog\Application\Query\Category\GetAll\GetAllCategoryQuery;
use App\Blog\Domain\Category\Exception\CategoryException;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use App\Symfony\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends RestController
{
    /**
     * @Route("/category/{page}/{limit}", name="categories", methods={"GET"}, defaults={"page": 1, "limit": 10}, requirements={"page"="\d+", "limit"="\d+"})
     */
    public function getAllCategoryAction(Request $request, int $page, int $limit): Response
    {
        $categories = $this->system->query(new GetAllCategoryQuery($page, $limit));

        return $this->render('category/category.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/create", name="create_cateogry_form", methods={"GET", "POST"})
     */
    public function createCategoryForm(Request $request): Response
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
            'form' => $form->createView(),
            'errors' => $form->getErrors(),
        ]);
    }

    /**
     * @Route("/category/edit/{id}", name="edit_category_form", methods={"GET"})
     * @ParamConverter("categoryView")
     */
    public function editCategoryFrom(Request $request, string $id, CategoryView $categoryView): Response
    {
        return $this->render('category/edit_category.html.twig', [
            'category' => $categoryView,
        ]);
    }

    /**
     * @Route("/category/edit/{id}", name="edit_category_action", methods={"POST"})
     * @ParamConverter("categoryView")
     */
    public function editCategoryAction(Request $request, string $id, CategoryView $categoryView): Response
    {
        try {
            $data = $request->request->all();
            $this->system->command(new EditCategoryCommand($categoryView->id, $data['name']));
            $this->addFlash('info', 'Success edit category');

            return $this->redirectToRoute('categories');
        } catch (CategoryException $exception) {
            $this->addFlash('error', $exception->getMessage());

            return $this->render('category/edit_category.html.twig', [
                'category' => $categoryView,
            ]);
        }
    }

    /**
     * @Route("/category/delete/{id}", name="delete_category_action", methods={"POST"})
     * @ParamConverter("categoryView")
     */
    public function deleteCategoryAction(Request $request, string $id, CategoryView $categoryView): Response
    {
        try {
            $this->system->command(new DeleteCategoryCommand($categoryView->id));
            $this->addFlash('info', 'Success delete category');

            return $this->redirectToRoute('categories');
        } catch (CategoryException $exception) {
            $this->addFlash('error', $exception->getMessage());

            return $this->redirectToRoute('categories');
        }
    }
}
