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
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivresController extends AbstractController
{
    #[Route('/admin/findall', name: 'FindAll_livres')]
    #[IsGranted("ROLE_ADMIN")]
    public function findall(LivresRepository $rep): Response
    {
$LesLivres=$rep->findAll();
        return $this->render('livres/findall.html.twig', [
            'livres' =>$LesLivres,
        ]);
    }

    #[Route('/livres/find/{id}', name: 'Find_livres')]
    public function find($id,LivresRepository $rep)
    {$livre=$rep->find($id);
        if(!$livre){
        throw $this->createNotFoundException("livre $id inexistant!!");
    }
        dd($livre);
    }



    /*#[Route('/admin/add', name: 'Ajouter_livres')]
    public function add(ManagerRegistry $doctrine): Response
    {
        $livre=new Livres();
        $date=new DateTime('22-08-2002');
        $livre->setLibelle('aaaaa')
              ->setResume('bbbb')
              ->setPrix('100')
              ->setImage('nnn')
              ->setEditeur('amal ghozzi')
              ->setDateEdition($date);
        $em=$doctrine->getManager();
        $em->persist($livre);
        $em->flush();
        return $this->redirectToRoute('FindAll_livres');
    
    
    
     userAuthenticator   }*/
        #[Route('/admin/add', name: 'Ajouter_livres')]
        #[IsGranted("ROLE_ADMIN")]
        public function add(Request $request, ManagerRegistry $doctrine): Response 
    {
        $livre=new Livres();
        $form=$this->createForm(LivreType::class,$livre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
        $livre=$form->getData();
        $em=$doctrine->getManager();
        $em->persist($livre);
        $em->flush();
       return new Response ("object livre ajouté avec succe");}
        return $this->render('livres/add.html.twig',['f'=>$form]);}





 #[Route('/admin/delete/{id}', name: 'delete_livre')]
 #[IsGranted("ROLE_ADMIN")]
    public function delete(Livres $livre,ManagerRegistry $doctrine): Response
    {
    
        $em=$doctrine->getManager();
        $em->remove($livre);
        $em->flush();
        return $this->redirectToRoute('FindAll_livres');}


        #[Route('/admin/update/{id}', name: 'update_livre')]
        #[IsGranted("ROLE_ADMIN")]
        public function update(Livres $livre,ManagerRegistry $doctrine): Response
        {
            $livre->setPrix('700');
            $em=$doctrine->getManager();
            $em->persist($livre);
            $em->flush();
            return $this->redirectToRoute('FindAll_livres');}








}