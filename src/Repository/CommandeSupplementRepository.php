<?php

namespace App\Repository;

use App\Entity\CommandeSupplement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeSupplement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeSupplement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeSupplement[]    findAll()
 * @method CommandeSupplement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeSupplementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeSupplement::class);
    }

    // /**
    //  * @return CommandeSupplement[] Returns an array of CommandeSupplement objects
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
    public function findOneBySomeField($value): ?CommandeSupplement
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
