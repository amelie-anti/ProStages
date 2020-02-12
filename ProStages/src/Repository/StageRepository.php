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
    
    public function findStageByEntrepriseQB($nom)
    {
        return $this->createQueryBuilder('s')
        ->join('s.entreprise','e')
        ->join('s.formations','f')
        ->addSelect('e')
        ->addSelect('f')
        ->andWhere('e.nom = :val')
        ->setParameter('val', $nom)
        ->orderBy('s.id', 'ASC')
        ->getQuery()
        ->getResult()
        ;
    }
    
    /**
    * @return Stage[] Returns an array of Stage objects
    */
    public function findStageByFormationDQL($nomCourt){
        return $this->getEntityManager()->createQuery('
        SELECT s, e, f
        FROM App\Entity\Stage s
        JOIN s.entreprise e
        JOIN s.formations f
        WHERE f.nomCourt = :val')
        ->setParameter('val', $nomCourt)
        ->execute()
        ;
    }

    /**
    * @return Stage[] Returns an array of Stage objects
    */
    public function recupFormationEtEntrerpise(){

        return $this->getEntityManager()->createQuery('
        SELECT s, e, f
        FROM App\Entity\Stage s
        JOIN s.entreprise e
        JOIN s.formations f')
        ->execute()
        ;
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
