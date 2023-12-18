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
    
    /*#[Route('admin/categories/add', name: 'add_categories')]
    public function add1(): Response
    {   $cat=new Categories();
        $form=$this->createFormBuilder($cat)
              ->add('libelle',DateType::class)
              ->add('description',TextType::class)
              ->add('Save',SubmitType::class)
              ->getForm();
              //traitment
              //récupération des données du champ de formulaire via l'object request
              //persister l'object catégorie

        return $this->render('categories/add.html.twig', [
            'f' =>$form
        ]);
    }*/



    #[Route('admin/categories/add', name: 'add_categories')]
    public function add(Request $request,ManagerRegistry $doctrine): Response
    {   $cat=new Categories();
        $form = $this->createForm(CategorieType::class,$cat); 
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
//hydrattation de l'object catégorie avec les données recu via l'object request
        $cat=$form->getData();//object mawjoudin fl form nhotohom fl $cat
        $em=$doctrine->getManager();
        $em->persist($cat);
        $em->flush();
        return new Response("object catégorie est ajouté avec succés");

        }          
              //traitment
              //récupération des données du champ de formulaire via l'object request
              //persister l'object catégorie

        return $this->render('categories/add.html.twig', [
            'f' =>$form
        ]);
    }
}
