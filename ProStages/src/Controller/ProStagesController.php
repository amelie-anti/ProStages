<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response; 

class ProStagesController extends AbstractController
{
    /**
     * @Route("/", name="ProStages-Accueil")
     */
    public function index()
    {
        return $this->render('ProStages/index.html.twig');

    }

    /**
     * @Route("/entreprises/{id}", name="ProStages-Entreprises")
     */
    public function entreprises($id)
    {
        return $this->render('ProStages/entreprises.html.twig', ['idEntreprises'=>$id]);
    }


    /**
     * @Route("/formations/{id}", name="ProStages-Formations")
     */
    public function formations($id)
    {
        return $this->render('ProStages/formations.html.twig', ['idFormations' => $id]);

    }

    /**
     * @Route("/stages/{id}", name="ProStages-Stages")
     */
    public function stages($id)
    {
        return $this->render('ProStages/stages.html.twig', ['idStages' => $id]);

    }

     /**
     * @Route("/ressourceStages/{id}", name="ProStages-ressourceStages")
     */
    public function ressourceStages($id)
    {
        return $this->render('ProStages/ressourceStages.html.twig', ['idRessourceStages' => $id]);

    }

}
