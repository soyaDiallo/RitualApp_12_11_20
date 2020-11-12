<?php

namespace App\Repository;

use App\Entity\ArticlePrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticlePrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlePrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlePrix[]    findAll()
 * @method ArticlePrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlePrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlePrix::class);
    }

    // /**
    //  * @return ArticlePrix[] Returns an array of ArticlePrix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticlePrix
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
