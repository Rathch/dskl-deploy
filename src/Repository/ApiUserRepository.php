<?php

namespace App\Repository;

use App\Entity\ApiUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ApiUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiUser[]    findAll()
 * @method ApiUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class ApiUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ApiUser::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ApiUser $apiUser, bool $flush = true): void
    {
        $this->_em->persist($apiUser);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ApiUser $apiUser, bool $flush = true): void
    {
        $this->_em->remove($apiUser);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ApiUser[] Returns an array of ApiUser objects
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
    public function findOneBySomeField($value): ?ApiUser
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
