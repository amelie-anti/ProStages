<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request; 
use Doctrine\Common\Persistence\ObjectManager;

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
     * @Route("/entreprises", name="ProStages-Entreprises")
     */
    public function entreprises()
    {
        //recuperer le repository de l'entité stage 
        $repositoryRessources = $this->getDoctrine()->getRepository(Entreprise::class);

        //récuperer les stages enregister en bd 
        $ressour = $repositoryRessources->findAll();

        //envoyer les stages récuperer à la vue charger de las afficher 
        return $this->render('ProStages/entreprises.html.twig', ['ressour'=>$ressour]);
    }

    /**
     * @Route("/formations", name="ProStages-Formations")
     */
    public function formations()
    {
        //recuperer le repository de l'entité stage 
        $repositoryRessources = $this->getDoctrine()->getRepository(Formation::class);

        //récuperer les stages enregister en bd 
        $ress= $repositoryRessources->findAll();

        //envoyer les stages récuperer à la vue charger de las afficher 
        return $this->render('ProStages/formations.html.twig', ['ress'=>$ress]);
    }

    /**
     * @Route("/stages", name="ProStages-Stages")
     */
    public function stages()
    {
        //recuperer le repository de l'entité stage 
        $repositoryRessources = $this->getDoctrine()->getRepository(Stage::class);

        //récuperer les stages enregister en bd 
        $ressources = $repositoryRessources->recupFormationEtEntrerpise();

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

    /**
     * @Route("/stagesParEntreprise/{nom}", name="ProStages-stagesParEntreprise")
     */
    public function stagesParEntreprise($nom)
    {
        //recuperer le repository de l'entité stage 
        $repositoryRessources = $this->getDoctrine()->getRepository(Stage::class);

        //récuperer les stages enregister en bd 
        $ressours = $repositoryRessources->findStageByEntrepriseQB($nom);

        //envoyer les stages récuperer à la vue charger de las afficher 
        return $this->render('ProStages/stagesParEntreprise.html.twig',['ressours'=>$ressours]);
    }

    /**
     * @Route("/stagesParFormation/{nomCourt}", name="ProStages-stagesParFormation")
     */
    public function stagesParFormation($nomCourt)
    {
        //recuperer le repository de l'entité stage 
        $repositoryRessources = $this->getDoctrine()->getRepository(Stage::class);

        //récuperer les stages enregister en bd 
        $ressour = $repositoryRessources->findStageByFormationDQL($nomCourt);

        //envoyer les stages récuperer à la vue charger de las afficher 
        return $this->render('ProStages/stagesParFormation.html.twig',['ressour'=>$ressour]);
    }

    /**
     * @Route("/ajoutEntreprise", name="ProStages-AjoutEntreprise")
     */
    public function ajoutEntreprise(Request $request, ObjectManager $manager)
    {

        //creation d'une ressource vierge qui sera remplie par le formulaire
        $entreprise = new Entreprise();

        //affiche la page d'ajout d'entreprise
        $formulaireEntreprise = $this->createFormBuilder($entreprise)
        ->add('nom')
        ->add('activiter', TextareaType::class)
        ->add('adresse')
        ->add('lienSiteWeb', UrlType::class)
        ->getForm();
       
        //on demande d'analyser la derniere requete http, 
        //recupere et affecte les donner recup au nouveau objet
        $formulaireEntreprise->handleRequest($request);

        if($formulaireEntreprise->isSubmitted()){
            $manager->persist($entreprise);
            $manager->flush();
            return $this->redirectToRoute('ProStages-Accueil');
        }
        //envoyer les formulaires récuperer à la vue charger de las afficher 
        return $this->render('ProStages/ajoutModifEntreprise.html.twig', ['vueFormulaire' =>  $formulaireEntreprise->createView(),'action'=>"ajouter"]);
    }

    /**
     * @Route("/modifierEntreprise/{id}", name="ProStages-ModifierEntreprise")
     */
    public function modifierEntreprise(Request $request, ObjectManager $manager, $id)
    {
        $repositoryRessources = $this->getDoctrine()->getRepository(Entreprise::class);
        $entreprise = $repositoryRessources->find($id);
        
        //affiche la page d'ajout d'entreprise
        $formulaireEntreprise = $this->createFormBuilder($entreprise)
        ->add('nom')
        ->add('activiter', TextareaType::class)
        ->add('adresse')
        ->add('lienSiteWeb', UrlType::class)
        ->getForm();
       
        //on demande d'analyser la derniere requete http, 
        //recupere et affecte les donner recup au nouveau objet
        $formulaireEntreprise->handleRequest($request);

        if($formulaireEntreprise->isSubmitted()){
            $manager->persist($entreprise);
            $manager->flush();
            return $this->redirectToRoute('ProStages-Accueil');
        }
        //envoyer les formulaires récuperer à la vue charger de las afficher 
        return $this->render('ProStages/ajoutModifEntreprise.html.twig', ['vueFormulaire' =>  $formulaireEntreprise->createView(),'action'=>"modifier" ] );
    }
}

   