<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends AbstractController
{
    public function index(): Response
    {
       return new Response("<h1>Hello Word!</h1>");
    }

    public function helloname($name): Response
    {
        return new Response("<h1>Hello ".$name."!</h1>"); 
    }
}