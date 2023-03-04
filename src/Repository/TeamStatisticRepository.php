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
