<?php

namespace App\Controller;

use DateTime;
use App\Entity\Livres;
use App\Form\LivreType;
use App\Repository\LivresRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivresController extends AbstractController
{
    #[Route('/livres/findall', name: 'findall_livres')]
    public function findall(LivresRepository $rep): Response
    {   $leslivres=$rep->findAll();
        return $this->render('livres/findall.html.twig', [
            'livres' =>$leslivres,
        ]);
    }

    #[Route('/livres/find/{id}', name: 'find_livre')]
    public function find(Livres $livre): Response
    {   dd($livre);
        
    }


    /*#[Route('/livres/add', name: 'add_livre')]
    public function add(ManagerRegistry $doctrine ): Response
    {   $livre=new Livres();
        $date=new DateTime("22-08-2002");
        $livre->setLibelle("aaaa");
        $livre->setResume("rrr");
        $livre->setPrix('500');
        $livre->setImage('hhhhh');
        $livre->setEditeur("amal");
        $livre->setDateedition($date);
        $em=$doctrine->getManager();
        $em->persist($livre);
        $em->flush();
        return $this->redirectToRoute('findall_livres');

    }*/


#[Route('/livres/delete/{id}', name: 'delete_livre')]
    public function delete(ManagerRegistry $doctrine,Livres $livre): Response

    {   $em=$doctrine->getManager();
        $em->remove($livre);
        $em->flush();
        return $this->redirectToRoute('findall_livres');

    }

    #[Route('/livres/update/{id}', name: 'update_livre')]
    public function update(ManagerRegistry $doctrine,Livres $livre): Response

    {   
        $livre->setPrix('1900');
        $em=$doctrine->getManager();
        $em->persist($livre);
        $em->flush();
        return $this->redirectToRoute('findall_livres');

    }


    #[Route('/livres/add', name: 'add_livre')]
    public function add(ManagerRegistry $doctrine,Request $request): Response
    {   $livre=new Livres();
        $form=$this->createForm(LivreType::class,$livre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $livre=$form->getData();
            $em=$doctrine->getManager();
            $em->persist($livre);
            $em->flush();
            return new Response("Ajout avec succés");
        }
        return $this->render('livres/add.html.twig', [
            'f' =>$form,
        ]);

    }


}
