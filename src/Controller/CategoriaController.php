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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria", name="categoria_index")
     * @IsGranted("ROLE_USER")
     */
    public function index(CategoriaRepository $categoriaRepository) : Response
    {
        //restringir a pagina apenas para os ROLE_USER
        //$this->denyAccessUnlessGranted("ROLE_USER");

        //buscar todas as categorias
        $data['categorias'] = $categoriaRepository->findAll();
        $data['titulo'] = 'Gerenciar Categorias';

        return $this->render('categoria/index.html.twig', $data);
    }

    /**
     * @Route("/categoria/adicionar", name="categoria_adicionar")
     * @IsGranted("ROLE_USER")
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

    /**
     * @Route("/categoria/editar/{id}", name="categoria_editar")
     * @IsGranted("ROLE_USER")
     */
    public function editar($id, Request $request, EntityManagerInterface $em, CategoriaRepository $categoriaRepository) : Response
    {
        $msg = '';
        $categoria = $categoriaRepository->find($id); //retorna a categoria pelo id
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush(); //fazer o update da categooria no bd
            $msg = 'Categoria atualizada com sucesso!';
        }

        $data['titulo'] = 'Editar Categoria';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderForm('categoria/form.html.twig', $data);
    }

    /**
     * @Route("/categoria/excluir/{id}", name="categoria_excluir")
     * @IsGranted("ROLE_USER")
     */
    public function excluir($id, EntityManagerInterface $em, CategoriaRepository $categoriaRepository) : Response
    {
        $categoria = $categoriaRepository->find($id);
        $em->remove($categoria); //excluir a categoria do bd (memoria)
        $em->flush(); //efetuar a exclusão

        //redirecionar a app para categoria_index
        return $this->redirectToRoute('categoria_index');
    }
}