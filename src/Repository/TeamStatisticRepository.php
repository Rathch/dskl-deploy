<?php

namespace App\Repository;

use App\Entity\TeamStatistic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TeamStatistic>
 *
 * @method TeamStatistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamStatistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamStatistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamStatisticRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeamStatistic::class);
    }

    public function findAllForEndlesStatistic(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM TeamStatistic ts
            WHERE 1
            group by ts.team_id
            order by ts.points  DESC , ts.goaleDifference  DESC,  ts.goales  DESC
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }

    public function findByGroupedByGoeales(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT SUM(goales) goales, team_id FROM TeamStatistic ts
            WHERE 1
            group by ts.team_id
            order by ts.goales  DESC
            LIMIT 10
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }

    public function findTopTenKills(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT SUM(kills) kills,ts.team_id FROM TeamStatistic ts
            WHERE 1
            group by ts.team_id
            order by kills  DESC 
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }



    public function add(TeamStatistic $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TeamStatistic $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
