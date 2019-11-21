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

        /*return new Response (
        '<html>
            <body>  
                <h1>  Bienvenue sur la page d-accueil de ProStage <3 <3 <3
                </h1>  
            </body>  
        </html>');
        */
    }

    /**
     * @Route("/entreprises", name="ProStages-Entreprises")
     */
    public function entreprises()
    {
        return $this->render('ProStages/entreprises.html.twig');
        /*return new Response (
        '<html>
            <body>  
                <h1>  Cette page affichera la liste des entreprises proposant un stage 
                </h1>  
            </body>  
        </html>');*/
    }


    /**
     * @Route("/formations", name="ProStages-Formations")
     */
    public function formations()
    {
        return $this->render('ProStages/formations.html.twig');

        /*return new Response (
        '<html>
            <body>  
                <h1>  Cette page affichera la liste des formations de l-IUT
                </h1>  
            </body>  
        </html>');*/
    }

    /**
     * @Route("/stages/{id}", name="ProStages-Stages")
     */
    public function stages($id)
    {
        return $this->render('ProStages/stages.html.twig', ['id_stage' => $id]);

        /*return new Response (
        '<html>
            <body>  
                <h1>  Cette page affichera le descriptif du stage ayant pour identifiant $id
                </h1>  
            </body>  
        </html>');*/
    }

}
