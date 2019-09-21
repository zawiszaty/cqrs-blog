<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends WebController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function getAllCategoryAction(Request $request): Response
    {
        return $this->render('home/home.html.twig');
    }
}
