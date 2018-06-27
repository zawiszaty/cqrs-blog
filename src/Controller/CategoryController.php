<?php

namespace App\Controller;

use App\Command\AddCategoryCommand;
use App\Command\DeleteCategoryCommand;
use App\Command\EditCategoryCommand;
use App\Entity\Category;
use App\Event\AddCategoryEvent;
use App\Form\AddCategoryType;
use App\Form\DeleteCategoryType;
use App\Form\EditCategoryType;
use App\Repository\Redis\CategoryRedisRepository;
use App\System\System;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Tests\CacheWarmer\CacheWarmerTest;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Predis\Client;
use Doctrine\Common\Cache\RedisCache;

class CategoryController extends Controller
{
    /**
     * @var System
     */
    private $system;

    public function __construct(System $system)
    {

        $this->system = $system;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     *
     * @Route("/category", name="add_category", methods="POST")
     */
    public function addCategoryAction(Request $request): Response
    {
        $data = [
            'name' => $request->request->get('name')
        ];
        $addCategoryCommand = new AddCategoryCommand($data['name']);
        $form = $this->createForm(AddCategoryType::class, $addCategoryCommand);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->system->handle($addCategoryCommand);

            return new JsonResponse('success', 200);
        }

        return new JsonResponse(
            [
                'status' => 'error',
                'errors' => $form->getErrors(),
            ],
            JsonResponse::HTTP_BAD_REQUEST
        );
    }

    /**
     * @return Response
     *
     * @Route("/category", name="get_all_category", methods="GET")
     */
    public function getAllCategoryAction(): Response
    {
        $data = $this->system->query(CategoryRedisRepository::class)->getAll();
        $jsonContent = $this->get('app.builder.response_builder')->build($data);

        return $jsonContent;
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Response
     *
     * @Route("/category/{id}", name="get_single_category", methods="GET")
     */
    public function getSingleCategoryAction(Request $request,string $id): Response
    {
        $data = $this->system->query(CategoryRedisRepository::class)->get($id);
        $jsonContent = $this->get('app.builder.response_builder')->build($data);

        return $jsonContent;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     *
     * @Route("/category", name="edit_category", methods="PUT")
     */
    public function editCategoryAction(Request $request): Response
    {
        $data = [
            'id' => $request->request->get('id'),
            'name' => $request->request->get('name')
        ];
        $editCategoryCommand = new EditCategoryCommand($data['id'],$data['name']);
        $form = $this->createForm(EditCategoryType::class, $editCategoryCommand);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->system->handle($editCategoryCommand);

            return new JsonResponse('success', 200);
        }

        return new JsonResponse(
            [
                'status' => 'error',
                'errors' => $form->getErrors(),
            ],
            JsonResponse::HTTP_BAD_REQUEST
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     *
     * @Route("/category", name="delete_category", methods="DELETE")
     */
    public function deleteCategoryAction(Request $request)
    {
        $data = [
            'id' => $request->request->get('id')
        ];
        $deleteCategoryCommand = new DeleteCategoryCommand($data['id']);
        $form = $this->createForm(DeleteCategoryType::class, $deleteCategoryCommand);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->system->handle($deleteCategoryCommand);

            return new JsonResponse('success', 200);
        }

        return new JsonResponse(
            [
                'status' => 'error',
                'errors' => $form->getErrors(),
            ],
            JsonResponse::HTTP_BAD_REQUEST
        );
    }
}