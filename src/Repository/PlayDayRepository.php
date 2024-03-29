<?php

namespace App\Repository;

use App\Entity\PlayDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayDay>
 *
 * @method PlayDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayDay[]    findAll()
 * @method PlayDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayDayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayDay::class);
    }

    public function add(PlayDay $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlayDay $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllMostTeamOfTheDay(): array
    {
        $conn = $this->getEntityManager()->getConnection();
//SELECT COUNT(`id`) as anzah,  `teamOfTheDay_id`  FROM `PlayDay` GROUP BY `teamOfTheDay_id` ORDER BY anzah DESC
        $sql = '
            SELECT COUNT(id) as anzahl,  teamOfTheDay_id  FROM PlayDay
            group by teamOfTheDay_id
            order by anzahl DESC 
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findAllMostPlayerOfTheDay(): array
    {
        $conn = $this->getEntityManager()->getConnection();
//SELECT COUNT(`id`) as anzah,  `teamOfTheDay_id`  FROM `PlayDay` GROUP BY `teamOfTheDay_id` ORDER BY anzah DESC
        $sql = '
            SELECT COUNT(id) as anzahl,  playerOfTheDay_id  FROM PlayDay
            group by playerOfTheDay_id
            order by anzahl DESC 
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return PlayDay[] Returns an array of PlayDay objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlayDay
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
