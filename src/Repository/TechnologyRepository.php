<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Technology;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TechnologyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Technology::class);
    }

    /**
     * @return Technology[]
     */
    public function findTechnologiesByExperience(int $experienceId): array
    {
        return $this->createQueryBuilder('t')
            ->select('t as technology', 'et.showInOverview')
            ->innerJoin('t.experienceTechnologies', 'et')
            ->innerJoin('et.experience', 'e')
            ->where('e.id = :experienceId')
            ->setParameter('experienceId', $experienceId)
            ->getQuery()
            ->getResult();
    }
}
