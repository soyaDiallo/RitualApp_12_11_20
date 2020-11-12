<?php

namespace App\Repository;

use App\Entity\ArticleSupplementPrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleSupplementPrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleSupplementPrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleSupplementPrix[]    findAll()
 * @method ArticleSupplementPrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleSupplementPrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleSupplementPrix::class);
    }

    // /**
    //  * @return ArticleSupplementPrix[] Returns an array of ArticleSupplementPrix objects
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
    public function findOneBySomeField($value): ?ArticleSupplementPrix
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
