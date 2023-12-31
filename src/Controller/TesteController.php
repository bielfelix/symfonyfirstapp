<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TesteController extends AbstractController
{
    /**
     * @Route("/teste", name="teste")
     */
    public function index() : Response
    {
        return new Response("<h1>Página de Teste");
    }

    /**
     * @Route("/teste/detalhes/{id}")
     */
    public function detalhes($id) : Response
    {
        return new Response("<h1>ID: ". $id ."</h1>");
    }
}
