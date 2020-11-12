<?php

namespace App\Repository;

use App\Entity\HoraireMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HoraireMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method HoraireMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method HoraireMenu[]    findAll()
 * @method HoraireMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HoraireMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HoraireMenu::class);
    }

    // /**
    //  * @return HoraireMenu[] Returns an array of HoraireMenu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HoraireMenu
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
