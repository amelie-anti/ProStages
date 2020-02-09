<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

     /**
      * @return Stage[] Returns an array of Stage objects
      */
    
    public function findStageByEntrepriseQB($id)
    {
        return $this->createQueryBuilder('s')
            ->join('s.entreprise','e')
            ->andWhere('e.nom = :numNom')
            ->setParameter('numNom', $id)
            ->getQuery()
            ->getResult()
        ;
    }
    

     /**
      * @return Stage[] Returns an array of Stage objects
      */
    public function findStageByFormationDQL(){
        $gestionaireEntite = $this -> getEntityManager();
        $requete = $gestionaireEntite ->createQuery(

            'select s,f 
            // from App/Entity/Stage s
            Join s.formation f '
        );
        return $requete ->execute();
    }

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
