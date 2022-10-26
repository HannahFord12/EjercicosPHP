<?php

namespace App\Controller;

use App\Entity\Ciudades;
use App\Entity\Pais;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\CiudadesType;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;


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
    public function builderForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('nombre', TextType::class)
            ->add('habitantes', TextType::class)
            ->add('alcalde', TextType::class)
            ->add('pais', EntityType::class, array(
                'class'=> Pais::class,
                'choice_label' => 'nombre',
            ))
            ->add('save', SubmitType::class, array('label'=>'Enviar'));
    }

    /**
     * @Route("/ciudades/nuevo", name="nuevo_ciudades")
     */
    public function nuevo(ManagerRegistry $doctrine, Request $request){ //no funciona la modificación
        $ciudades=new Ciudades();

        $formulario=$this->createForm(CiudadesType::class, $ciudades);//easto da error
        $formulario ->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $ciudades = $formulario->getData();
            $entityManager = $doctrine->getManager();
            $entityManager -> persist($ciudades);
            $entityManager-> flush();
            return $this->redirectToRoute('ficha_ciudades', ["codigo" => $ciudades-> getId()]);
        }
        return $this->render('nuevo.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }
    /**
     * @Route("/ciudades/editar/{codigo}", name="editar_ciudades", requirements={"codigo"="\d+"})
     */

    public function editar(ManagerRegistry $doctrine, Request $request, $codigo){
        $repositorio =$doctrine ->getRepository(Ciudades::class);
        $ciudades=$repositorio ->find($codigo);
       if($ciudades){
            $formulario = $this->createForm(CiudadesType::class, $ciudades);
       
            $formulario->handleRequest($request);

            if ($formulario->isSubmitted() && $formulario->isValid()) {
                $contacto = $formulario->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($contacto);
                $entityManager->flush();
                return $this->redirectToRoute('ficha_ciudades', ["codigo" => $contacto->getId()]);
            }
            return $this->render('nuevo.html.twig', array(
                'formulario' => $formulario->createView()
            ));
        }else{
            return $this->render('ficha_contacto.html.twig', [
                'contacto' => NULL
            ]);
        }
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
     * @Route("/ciudades/insertarSinPais", name="insertar_sin_provincia_contacto")
     */
    public function insertarSinProvincia(ManagerRegistry $doctrine): Response{
        $entityManager=$doctrine->getManager();
        $repositorio=$doctrine->getRepository(Pais::class);

        $pais=$repositorio->findOneBy(["nombre" => "Alemania"]);

        $ciudades=new Ciudades();

        $ciudades->setNombre("Berlin");
        $ciudades->setHabitantes("900220022");
        $ciudades->setAlcalde("Merquel");
        $ciudades->setPais($pais); 

        $entityManager->persist($ciudades);

        $entityManager->flush();
        return $this->render('ficha_contacto.html.twig',[
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
