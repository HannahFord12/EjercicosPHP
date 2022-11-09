<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Post;
use App\Form\PostFormType;

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
    * @Route("/single_post/{slug}", name="single_post")
    */
    public function post(ManagerRegistry $doctrine, $slug): Response
    {
        $repositorio = $doctrine->getRepository(Post::class);
        $post = $repositorio->findOneBy(["slug"=>$slug]);
        return $this->render('blog/single_post.html.twig', [
            'post' => $post,
        ]);
    }
    /**
    * @Route("/blog/new", name="new_post")
    */
    public function newPost(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();   
            $post->setSlug($slugger->slug($post->getTitle()));
            $post->setPostUser($this->getUser());
            $post->setNumLikes(0);
            $post->setNumComments(0);
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->render('blog/new_post.html.twig', array(
                'form' => $form->createView()    
            ));
            //return $this->redirectToRoute('single_post', ["slug" => $post->getSlug()]);
        }   //todos los que redirigen a singel post hay que ponerlos a slug
        return $this->render('blog/new_post.html.twig', array(
            'form' => $form->createView()    
        ));
    }

}
