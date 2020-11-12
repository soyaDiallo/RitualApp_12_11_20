<?php

namespace App\Repository;

use App\Entity\Consommateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Consommateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consommateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consommateur[]    findAll()
 * @method Consommateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsommateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consommateur::class);
    }

    // /**
    //  * @return Consommateur[] Returns an array of Consommateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Consommateur
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
