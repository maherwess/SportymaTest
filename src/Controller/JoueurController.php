<?php

namespace App\Controller;

use App\Entity\Club;
use App\Entity\Joueur;
use App\Repository\JoueurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoueurController extends AbstractController
{
    /**
     * @Route("/joueur/{id}", name="joueur", methods={"GET"},defaults={"id"=null})
     */
    public function index(JoueurRepository $joueurRepository, $id=null): Response
    {

        if($id){
            $joueurs = $joueurRepository->findByClub($id);
        }else{
            $joueurs = $joueurRepository->findAll();
        }

        return $this->render('joueur/index.html.twig', [
            'joueurs' => $joueurs
        ]);
    }

}
