<?php

namespace App\Repository;

use App\Entity\ArticleCategorieArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleCategorieArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleCategorieArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleCategorieArticle[]    findAll()
 * @method ArticleCategorieArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleCategorieArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleCategorieArticle::class);
    }

    // /**
    //  * @return ArticleCategorieArticle[] Returns an array of ArticleCategorieArticle objects
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
    public function findOneBySomeField($value): ?ArticleCategorieArticle
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
