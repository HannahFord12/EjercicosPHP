<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
    /**
     * @Route("/blog", name="blog")
     */
    public function blog():Response{
        return $this->render('publi/contacto.html',[]);
    }
    /**
     * @Route("/single_post", name="single_post")
     */
    public function single_post():Response{
        return $this->render('publi/single_post.html',[]);
    }
}
