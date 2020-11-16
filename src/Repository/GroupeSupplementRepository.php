<?php

namespace App\Repository;

use App\Entity\GroupeSupplement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupeSupplement|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeSupplement|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeSupplement[]    findAll()
 * @method GroupeSupplement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeSupplementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeSupplement::class);
    }

    // /**
    //  * @return GroupeSupplement[] Returns an array of GroupeSupplement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupeSupplement
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
