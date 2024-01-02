<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdutoController extends AbstractController
{
    /**
     * @Route("/produto", name="produto_index")
     */
     public function index(ProdutoRepository $produtoRepository)
     {
        //busca produtos cadastrados
        $data['produtos'] = $produtoRepository->findAll();
        $data['titulo'] = 'Gerenciar Produtos';

        return $this->render('produto/index.html.twig', $data);
     }

     /**
     * @Route("/produto/adicionar", name="produto_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {
        $msg = '';
        $produto = new Produto();
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            //salva o produto no bd
            $em->persist($produto);
            $em->flush();
            $msg = 'Produto cadastrado com sucesso!';
        }

        $data['titulo'] = 'Adicionar novo produto';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderForm('produto/form.html.twig', $data);
    }

     /**
     * @Route("/produto/editar/{id}", name="produto_editar")
     */
    public function editar($id, Request $request, EntityManagerInterface $em, ProdutoRepository $produtoRepository) : Response
    {
        $msg = '';
        $produto = $produtoRepository->find($id);
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $msg = 'Produto atualizado com sucesso!';
        }

        $data['titulo'] = 'Editar Produto';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderForm('produto/form.html.twig', $data);
    }

     /**
     * @Route("/produto/excluir/{id}", name="produto_excluir")
     */
    public function excluir($id, EntityManagerInterface $em, ProdutoRepository $produtoRepository) : Response
    {
        $produto = $produtoRepository->find($id);
        $em->remove($produto);
        $em->flush();

        //redireciona para listagem do produto produto_index
        return $this->redirectToRoute('produto_index');
    }

}