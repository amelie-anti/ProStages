<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //création d'un générateur de données faker
        $faker = \Faker\Factory::create('fr_FR');

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
            $nbEntreprise = 9 ;

            for ($i = 1 ; $i <= $nbEntreprise ; $i++){
            $Entreprises = new Entreprise();
            $Entreprises->setNom($faker->company);
            $Entreprises->setActiviter($faker->realText($maxNbChars = 200, $indexSize = 2));
            $Entreprises->setAdresse($faker->address);
            $Entreprises->setLienSiteWeb($faker->url);
            $manager->persist($Entreprises);
            }
        
        //Création des ressources assosier au Formation
        $nbStagesAGenerer = 9 ;

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
        $numEntreprise = $faker->numberBetween($min=0, $max=8);
        $Stages->setEntreprise($Entreprises);
        $Entreprises->addStage($Stages);

        $manager->persist($Stages);
        $manager->persist($Entreprises);
        }
        $manager->flush();
    }   
        
    }

?>
