<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategorieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
    /*#[Route('/categories/add', name: 'app_categories')]
    public function add(): Response
    {   $cat=new Categories();
        $form=$this->createFormBuilder($cat)
             ->add('libelle',DateType::class)
             ->add('description',TextType::class)
             ->add('Ajouter',SubmitType::class)
             ->getForm();
        return $this->render('categories/add.html.twig', [
            'f' => $form,
        ]);
    }*/

 #[Route('/categories/add1', name: 'app_categories')]
    public function add(Request $request,ManagerRegistry $doctrine): Response
    {   $cat=new Categories();
        $form=$this->createForm(CategorieType::class,$cat);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $cat=$form->getData();
            $em=$doctrine->getManager();
            $em->persist($cat);
            $em->flush();
            return new Response ('object inseré avec succés');
        }
        return $this->render('categories/add.html.twig', [
            'f' => $form,
        ]);
    }

}
