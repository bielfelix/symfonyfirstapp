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
        $data["titulo"] = "Pagina teste";
        $data["msg"] = "Aprendendo Symfony";
        $data["frutas"] = ['banana', 'maça', 'uva'];
        $data['verduras'] = [
            [
                'nome' => 'alface',
                'valor' => 1.99
            ],
            [
                'nome' => 'tomate',
                'valor' => 3.90
            ],
            [
                'nome' => 'cenoura',
                'valor' => 2.45
            ]
        ];
        return $this->render("teste/index.html.twig", $data);
    }

    /**
     * @Route("/teste/detalhes/{id}")
     */
    public function detalhes($id) : Response
    {
        $data['titulo'] = "Pagina de detalhes";
        $data["id"] = $id;
        return $this->render("teste/detalhes.html.twig", $data);
    }
}
