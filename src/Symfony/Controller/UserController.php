<?php

declare(strict_types=1);

namespace App\Symfony\Controller;

use App\Blog\Application\Command\User\RegistrationUserCommand;
use App\Symfony\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends WebController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request): Response
    {
        $form = $this->createForm(RegistrationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->system->command(new RegistrationUserCommand($data['username'], $data['plainPassword']));
            $this->addFlash('info', 'Success registration');

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
