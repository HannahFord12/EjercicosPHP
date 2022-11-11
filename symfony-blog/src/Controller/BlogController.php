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
use App\Entity\Comment;


class BlogController extends AbstractController
{
    #[Route('/blog/{page}', name: 'blog', requirements: ['page' => '\d+'])]
    public function index(ManagerRegistry $doctrine, int $page = 1): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAllPaginated($page);

        return $this->render('blog/blog.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog(ManagerRegistry $doctrine):Response{
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll();
        $recents = $repository->findRecents();
        return $this->render('blog/blog.html.twig', [
            'posts' => $posts,
            'recents' => $recents
        ]);
        
    }
    
    #[Route('/single_post/{slug}', name: 'single_post')]
    public function post(ManagerRegistry $doctrine, $slug): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $post = $repository->findOneBy(["Slug"=>$slug]);
        $recents = $repository->findRecents();
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setPost($post);  
            //Aumentamos en 1 el número de comentarios del post
            $post->setNumComments($post->getNumComments() + 1);
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('single_post', ["slug" => $post->getSlug()]);
        }
        return $this->render('blog/single_post.html.twig', [
            'post' => $post,
            'recents' => $recents,
            'commentForm' => $form->createView()
        ]);
    }

    /**
    * @Route("/blog/new", name="new_post")
    */
    public function newPost(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();   
            $post->setSlug($slugger->slug($post->getTitle()));
            $post->setPostUser($this->getUser());
            $post->setNumLikes(0);
            $post->setNumComments(0);
            $entityManager = $doctrine->getManager();    
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('single_post', ["slug" => $post->getSlug()]);

            //return $this->redirectToRoute('single_post', ["slug" => $post->getSlug()]);
        }   //todos los que redirigen a singel post hay que ponerlos a slug
        return $this->render('blog/new_post.html.twig', array(
            'form' => $form->createView()    
        ));
    }
    
}
