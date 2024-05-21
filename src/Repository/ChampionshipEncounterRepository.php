<?php

namespace App\Repository;

use App\Entity\ChampionshipEncounter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChampionshipEncounter>
 *
 * @method ChampionshipEncounter|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChampionshipEncounter|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChampionshipEncounter[]    findAll()
 * @method ChampionshipEncounter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChampionshipEncounterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChampionshipEncounter::class);
    }
}
