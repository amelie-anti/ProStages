<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response; 

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

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
        //recuperer le repository de l'entité stage 
    $repositoryRessources = $this->getDoctrine()->getRepository(Entreprise::class);

    //récuperer les stages enregister en bd 
    $ressour = $repositoryRessources->findAll($id);

//envoyer les stages récuperer à la vue charger de las afficher 
        return $this->render('ProStages/entreprises.html.twig', ['ressour'=>$ressour]);
    }


    /**
     * @Route("/formations/{id}", name="ProStages-Formations")
     */
    public function formations($id)
    {
        //recuperer le repository de l'entité stage 
    $repositoryRessources = $this->getDoctrine()->getRepository(Formation::class);

    //récuperer les stages enregister en bd 
    $ress= $repositoryRessources->findAll($id);

    //envoyer les stages récuperer à la vue charger de las afficher 
        return $this->render('ProStages/formations.html.twig', ['ress'=>$ress]);

    }

    /**
     * @Route("/stages/{id}", name="ProStages-Stages")
     */
    public function stages($id)
    {
        //recuperer le repository de l'entité stage 
    $repositoryRessources = $this->getDoctrine()->getRepository(Stage::class);

    //récuperer les stages enregister en bd 
    $ressources = $repositoryRessources->findAll();

    //envoyer les stages récuperer à la vue charger de las afficher 
        return $this->render('ProStages/stages.html.twig',['ressources'=>$ressources]);

    }

     /**
     * @Route("/ressourceStages/{id}", name="ProStages-ressourceStages")
     */
    public function ressourceStages($id)
    {
        //recuperer le repository de l'entité stage 
    $repositoryRessources = $this->getDoctrine()->getRepository(Stage::class);

    //récuperer les stages enregister en bd 
    $ressource = $repositoryRessources->find($id);

    //envoyer les stages récuperer à la vue charger de las afficher 
    return $this->render('ProStages/ressourceStages.html.twig',['ressource'=>$ressource]);
    }

}
