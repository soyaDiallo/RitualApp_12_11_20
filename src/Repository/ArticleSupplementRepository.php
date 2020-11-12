<?php

namespace App\Repository;

use App\Entity\ArticleSupplement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleSupplement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleSupplement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleSupplement[]    findAll()
 * @method ArticleSupplement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleSupplementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleSupplement::class);
    }

    // /**
    //  * @return ArticleSupplement[] Returns an array of ArticleSupplement objects
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
    public function findOneBySomeField($value): ?ArticleSupplement
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
