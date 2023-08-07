<?php

namespace App\Repository;

use App\Entity\Squad;
use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Squad>
 *
 * @method Squad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Squad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Squad[]    findAll()
 * @method Squad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SquadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Squad::class);
    }

    public function add(Squad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Squad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMostValueByTeam(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT SUM(value) value,s.team_id FROM Squad s
            WHERE 1
            group by s.team_id
            order by value  DESC 
            LIMIT 10
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }

    public function findMostValueByPossition($position): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT s.value,s.position,s.team_id, s.firstName,s.figthName,s.name  FROM Squad s
            WHERE s.position = :position 
            order by s.value  DESC 
            LIMIT 10
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['position' => $position]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }

    public function findAvrageAgeByTeam($team) {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT AVG(s.birthYear) avrageAge,s.team_id  FROM Squad s
            WHERE s.team_id = :team 
            order by avrageAge  DESC
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['team' => $team->getId()]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAssociative();
    }

    public function findAllMethaTyps(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT s.methaTyp  FROM Squad s
            WHERE 1 
            group by s.methaTyp
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findMostByMethaAndTeam($methaTyp): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT s.team_id, count(s.methaTyp) methaTypAmount,methaTyp  FROM Squad s
            WHERE s.methaTyp = :methaTyp 
            group by s.team_id
            order by methaTypAmount  DESC 
            LIMIT 10
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['methaTyp' => $methaTyp]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }

//    /**
//     * @return Squad[] Returns an array of Squad objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Squad
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
