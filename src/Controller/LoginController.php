<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function index(AuthenticationUtils $authUltils): Response
    {
        //pegar o erro do login caso exista
        $erro = $authUltils->getLastAuthenticationError();

        //pegar o ultimo email informado pelo usuario
        $lastUsername = $authUltils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'erro' => $erro,
            'lastUsername' => $lastUsername
        ]);
    }
}
