<?php

namespace App\Repository;

use App\Entity\RelegationEncounter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RelegationEncounter>
 *
 * @method RelegationEncounter|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelegationEncounter|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelegationEncounter[]    findAll()
 * @method RelegationEncounter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelegationEncounterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelegationEncounter::class);
    }

    public function add(RelegationEncounter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RelegationEncounter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RelegationEncounter[] Returns an array of RelegationEncounter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RelegationEncounter
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
