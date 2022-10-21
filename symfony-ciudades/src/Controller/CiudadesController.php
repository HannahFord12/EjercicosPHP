<?php

namespace App\Controller;
use App\Entity\Ciudades;
use App\Entity\Pais;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntType;
//use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CiudadesType;

class CiudadesController extends AbstractController
{
    private $ciudades=[
        1 => ["nombre" => "Madird", "habitantes" =>"10000000", "alcalde"=>"Almeida"],
        2 => ["nombre" => "Barcelona", "habitantes"=> "7826638", "alcalde"=>"M Teresa Alfons"],
        3 => ["nombre" => "Londres", "habitantes"=> "678473685", "alcalde"=> "Jonson"],
        4 => ["nombre" => "Swindom", "habitantes"=> "24536578", "alcalde"=> "Brown"],
    ];
    #[Route('/ciudades', name: 'app_ciudades')]
    public function index(): Response
    {
        return $this->render('ciudades/index.html.twig', [
            'controller_name' => 'CiudadesController',
        ]);
    }
     /**
     * @Route("/ciudades/insertar", name="insertar_ciudades")
     */
    public function insertar(ManagerRegistry $doctrine){
        $entityManager=$doctrine->getManager();
        foreach($this->ciudades as $c){
            $ciudades =new Ciudades();
            $ciudades->setNombre($c["nombre"]);
            $ciudades->setHabitantes($c["habitantes"]);
            $ciudades->setAlcalde($c["alcalde"]);
            $entityManager->persist($ciudades);
        }
        try{
            $entityManager->flush();
            return new Response("Ciudades internas");
        }catch(\Exception $e){
            return new Response("Error interno");
        }
    }
    /**
     * @Route("/ciudades/update/{id}/{nombre}", name="modificar_ciudades")
     */
    public function update(ManagerRegistry $doctrine, $id, $nombre): Response{
        $entityManager =$doctrine->getManager();
        $repositorio =$doctrine -> getRepository(Ciudades::class);
        $ciudades = $repositorio -> find($id);
        if($ciudades){
            $ciudades->setNombre($nombre);
            try{
                $entityManager->flush();
                return $this->render('ficha_ciudades.html.twig',[
                    'ciudades' => $ciudades
                ]);
            }catch (\Exception $e){
                return new Response("Error insertando objeto");
            }
        }else
            return $this ->render('ficha_ciudades.html.twig', [
                'ciudades' => null
            ]);
    }
     /**
     * @Route("/ciudades/delete/{id}", name="eliminar_ciudades")
     */
    public function delete(ManagerRegistry $doctrine, $id): Response{
        $entityManager  =$doctrine->getManager();
        $repositorio = $doctrine->getRepository(Ciudades::class);
        $ciudades=$repositorio->find($id);
        if($ciudades){
            try{
                $entityManager->remove($ciudades);
                $entityManager->flush();
                return new Response("ciudad eliminada");
            }catch(\Exception $e){
                return new Response("Error eliminado objeto");
            }
        }else
            return $this->render('ficha_ciudades.html.twig',[
                'ciudades'=>null
            ]);
        
    }
    /**
     * @Route("/ciudades/insertarConPais", name="insertar_con_pais_ciudades")
     */
    public function insertarConPais(ManagerRegistry $doctrine): Response{
        $entityManager =$doctrine->getManager();
        $pais=new Pais();

        $pais->setNombre("Alemania");
        $ciudades=new Ciudades();

        $ciudades->setNombre("Berlin");
        $ciudades->setHabitantes("900220022");
        $ciudades->setAlcalde("Merquel");
        $ciudades->setPais($pais);

        $entityManager->persist($pais);
        $entityManager->persist($ciudades);

        $entityManager->flush();
        return $this->render('ficha_ciudades.html.twig',[
            'ciudades'=>$ciudades
        ]);
    }
    /**
     * @Route("/ciudades/{codigo}", name="ficha_ciudades")
     */
    public function ficha(ManagerRegistry $doctrine, $codigo){
        $repositorio=$doctrine ->getRepository(Ciudades::class);
        $ciudades=$repositorio->find($codigo);

        
        return $this ->render('ficha_ciudades.html.twig', [ 
            'ciudades'=> $ciudades]);
        
    }

    /**
     * @Route("/ciudades/buscar/{texto}", name="buscar_ciudades")
     */

     public function buscar(ManagerRegistry $doctrine, $texto): Response{
        $repositorio =$doctrine->getRepository(Ciudades::class);
        $ciudades=$repositorio->findByName($texto); 

        return $this->render('lista_ciudades.html.twig', [
            'ciudades' => $ciudades
        ]);
    }
   
}
