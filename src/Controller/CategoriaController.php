<?php

namespace App\Controller;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use App\Controller\Exception;

class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria", name="categoria_index")
     */
    public function index(EntityManagerInterface $em) : Response
    {
        //$em é um obj que vai auxiliar a execução de ações no BD
        $categoria = new Categoria();
        $categoria->setDescricaocategoria("Informática");
        $msg = "";

        try{
            $em->persist($categoria); //salvar em nivel de memoria
            $em->flush(); //executa no BD
            $msg = "Categoria salva com sucesso";
        }
        catch(Exception $e){ 
            $msg = "Error ao cadastrar categoria";
        }
        return new Response("<h1>".$msg."</h1>");
    }
}