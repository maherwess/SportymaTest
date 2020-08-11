<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\ButRepository;
use App\Repository\LogoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueController extends AbstractController
{

    /**
     * @Route("/statistique/{id}", name="statistique", methods={"GET"},defaults={"id"=null})
     */
    public function statistiqueAction(ButRepository $butRepository, $id=null): Response
    {

        if($id){
            $stats = $butRepository->findStats($id);
        }else{
            $stats = $butRepository->findAll();
        }

        return $this->render('statistique/index.html.twig', [
            'stats' => $stats
        ]);
    }

    /**
     * @Route("/historique/{id}", name="historique", methods={"GET"},defaults={"id"=null})
     */
    public function historiqueAction(LogoRepository $logoRepository, $id=null, Request $request): Response
    {

        //Initialiser un object de recherche pour filtrer l'historique des logos par une date de début et une date de fin
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$search);
        $form->handleRequest($request);

        //Vérifier si on a un filtre par club pour avoir l'historique de logos pour ce club
        // sinon interroger ka base pour avoir tout les historiques de logos
        if($id){
            $historiques = $logoRepository->findLogosByClub($id,$search);
        }else{
            $historiques = $logoRepository->findAllLogos($search);
        }

        return $this->render('statistique/historiqueLogos.html.twig', [
            'historiques' => $historiques,
            'form' => $form->createView()
        ]);
    }
}
