<?php

namespace App\Repository;

use App\Entity\Relegation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Relegation>
 *
 * @method Relegation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Relegation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Relegation[]    findAll()
 * @method Relegation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelegationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Relegation::class);
    }

//    /**
//     * @return Relegation[] Returns an array of Relegation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Relegation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
