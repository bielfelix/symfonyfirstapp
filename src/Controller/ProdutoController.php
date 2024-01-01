<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdutoController extends AbstractController
{
    /**
     * @Route("/produto", name="produto_index")
     */
     public function index(EntityManagerInterface $em, CategoriaRepository $CategoriaRepository)
     {
        $categoria = $CategoriaRepository->find(1); //1 = categoria Informática
        $produto = new Produto();
        $produto->setNomeproduto("Notebook");
        $produto->setValor(3000);
        $produto->setCategoria($categoria);

        $msg = "";

        try{
            $em->persist($produto); //salvar em nivel de memoria
            $em->flush(); //executa no BD
            $msg = "Produto salva com sucesso";
        }
        catch(Exception $e){ 
            $msg = "Error ao cadastrar produto";
        }
        return new Response("<h1>".$msg."</h1>");
     }
}