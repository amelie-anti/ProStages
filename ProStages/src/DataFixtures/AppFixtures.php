<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //création d'un générateur de données faker
        $faker = \Faker\Factory::create('fr_FR');


        //création des utilisateurs : 
        $amelie = new User();
        $amelie->setPrenom("Amélie");
        $amelie->setNom("Antigny");
        $amelie->setEmail("amelie@free.fr");
        $amelie->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $amelie->setPassword('$2y$10$j8gSNQlvJnV.7x/MqmMQU.lzo4vieFe8arHG0NBbg1QJAfroGd0L6');
        $manager->persist($amelie);

        $theo = new User();
        $theo->setPrenom("Théo");
        $theo->setNom("Malboef");
        $theo->setEmail("theo@free.fr");
        $theo->setRoles(['ROLE_USER']);
        $theo->setPassword('$2y$10$4uXyGPZTUndnm5TzHKKW4e77eDX1SQc/6kojMOJWgvfcYesPkwb7G');
        $manager->persist($theo);

        //création des 3 formations : 
        //DUT 
        $FormationDUT = new Formation();
        $FormationDUT->setNomCourt("DUT Informatique");
        $FormationDUT->setNomLong("Diplôme Universitaire Technologique en Informatique");
        $manager->persist($FormationDUT);
        //LP
        $FormationLP = new Formation();
        $FormationLP->setNomCourt("LP Multimédia");
        $FormationLP->setNomLong("Licence Professionnelle Multimédias");
        $manager->persist($FormationLP);
        //DU
        $FormationDU = new Formation();
        $FormationDU->setNomCourt("DU TIC");
        $FormationDU->setNomLong("Diplôme Universitaire en Technologies de l'Information et de la communication");
        $manager->persist($FormationDU);

        //Création des Entreprises 
        $nbEntreprise = 3 ;

        for ($i = 1 ; $i <= $nbEntreprise ; $i++){
            $Entreprises = new Entreprise();
            $Entreprises->setNom($faker->company);
            $Entreprises->setActiviter($faker->realText($maxNbChars = 200, $indexSize = 2));
            $Entreprises->setAdresse($faker->address);
            $Entreprises->setLienSiteWeb($faker->url);
            $manager->persist($Entreprises);
       
        //Création des ressources assosier au Formation
        $nbStagesAGenerer = 3 ;

            for ($NumStage = 1 ; $NumStage <= $nbStagesAGenerer ; $NumStage++){
                $Stages = new Stage();
                $Stages->setTitre("Stage");
                $Stages->setNom($faker->realText($maxNbChars = 20, $indexSize = 2));
                $Stages->setActiviter($faker->realText($maxNbChars = 200, $indexSize = 2));
                $Stages->setAdresse($faker->address);
                $Stages->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
                $Stages->setEmail($faker->email);

                $Stages->addFormation($FormationDUT);

                $Stages->addFormation($FormationLP);

                $Stages->addFormation($FormationDU);

                //Définir l'entreprise lier au stage
                $Stages->setEntreprise($Entreprises);
                $Entreprises->addStage($Stages);

                $manager->persist($Stages);
                $manager->persist($Entreprises);
            }
        }   
        $manager->flush();
    }        
}

?>
