<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

     /**
     * @Route("/ajoutUser", name="app_ajoutUser")
     */
    public function ajoutUser(Request $request, ObjectManager $manager,  UserPasswordEncoderInterface $encoder)
    {
        //creation d'une ressource vierge qui sera remplie par le formulaire
        $user = new User();

        //affiche la page d'ajout d'entreprise
        $formulaireUser = $this->createForm(UserType::class, $user);
    
        //on demande d'analyser la derniere requete http, 
        //recupere et affecte les donner recup au nouveau objet
        $formulaireUser->handleRequest($request);

        if($formulaireUser->isSubmitted() && $formulaireUser->isValid()){
            $user->setRoles(['ROLE_USER']);

            //Encoder le mot de passe de l'utilisateur
            $encodagePassword = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encodagePassword);

            // Enregistrer l'utilisateur en base de données
            $manager->persist($user);
            $manager->flush();

            // Rediriger l'utilisateur vers la page de login
            return $this->redirectToRoute('ProStages-Accueil');
        }
        //envoyer les formulaires récuperer à la vue charger de las afficher 
        return $this->render('ProStages/ajoutUser.html.twig',['vueFormulaireUser' => $formulaireUser->createView()]);
    }
}
