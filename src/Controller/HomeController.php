<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Entity\SaisonSearch;
use App\Form\PropertySearchType;
use App\Form\SaisonSearchType;
use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(ClubRepository $clubRepository, Request $request): Response
    {
        //Initialiser un object de recherche pour filtrer les clubs par une saison donnée
        $search = new SaisonSearch();
        $form = $this->createForm(SaisonSearchType::class,$search);

        $form->handleRequest($request);

        //Vérifier si on a un filtre par saison sinon interroger ka base pour avoir tout les clubs
        if($search->getSaison()){
            $clubs = $clubRepository->findBySaisons($search->getSaison()->getId());
        }else{
            $clubs = $clubRepository->findAll();
        }
        return $this->render('home/index.html.twig', [
            'clubs' => $clubs,
            'form' => $form->createView()
        ]);
    }


}
