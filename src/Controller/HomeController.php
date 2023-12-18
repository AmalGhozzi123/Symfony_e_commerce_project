<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\LivresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home',name: 'home')]
    public function home(LivresRepository $rep): Response
    {
$LesLivres=$rep->findAll();
        return $this->render('home/home.html.twig', [
            'livres' =>$LesLivres,
        ]);
    }


    #[Route('/cat/{id}', name: 'LivrebyCategorie')]
    public function LivrebyCategorie(Categories $cat): Response
    {   $livres=$cat-> getLivres();
        return $this->render('home/home.html.twig', [
            'livres' =>$livres,
        ]);
    }

}
