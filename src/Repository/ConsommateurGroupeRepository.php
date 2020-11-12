<?php

namespace App\Repository;

use App\Entity\ConsommateurGroupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConsommateurGroupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsommateurGroupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsommateurGroupe[]    findAll()
 * @method ConsommateurGroupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsommateurGroupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsommateurGroupe::class);
    }

    // /**
    //  * @return ConsommateurGroupe[] Returns an array of ConsommateurGroupe objects
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
    public function findOneBySomeField($value): ?ConsommateurGroupe
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
