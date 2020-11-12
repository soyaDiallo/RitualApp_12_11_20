<?php

namespace App\Repository;

use App\Entity\ArticleMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleMenu[]    findAll()
 * @method ArticleMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleMenu::class);
    }

    // /**
    //  * @return ArticleMenu[] Returns an array of ArticleMenu objects
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
    public function findOneBySomeField($value): ?ArticleMenu
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
