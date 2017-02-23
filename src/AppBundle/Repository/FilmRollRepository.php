<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Estimate;
use AppBundle\Entity\Office;
use Doctrine\ORM\EntityRepository;

class FilmRollRepository extends EntityRepository
{
    public function findAll()
    {
        $manager = $this->getEntityManager();
        $qb = $manager->createQueryBuilder();

        $qb
            ->select('fr, f')
            ->from('AppBundle:FilmRoll', 'fr')
            ->innerJoin('fr.film', 'f')
        ;

        return $qb->getQuery()->getResult();
    }
}
