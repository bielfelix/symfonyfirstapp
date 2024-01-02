<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use App\Controller\Exception;

class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria", name="categoria_index")
     */
    public function index(CategoriaRepository $categoriaRepository) : Response
    {
        //buscar todas as categorias
        $data['categorias'] = $categoriaRepository->findAll();
        $data['titulo'] = 'Gerenciar Categorias';

        return $this->render('categoria/index.html.twig', $data);
    }

    /**
     * @Route("/categoria/adicionar", name="categoria_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {
        $msg = '';
        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request); //associar a entidade

        if ($form->isSubmitted() && $form->isValid()) {
            //salvar a categoria no bd
            $em->persist($categoria); //salva na memoria
            $em->flush(); //salva no bd
            $msg = 'Categoria salva com sucesso!';
        }

        $data['titulo'] = 'Adicionar Nova Categoria';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderForm('categoria/form.html.twig', $data);
    }
}