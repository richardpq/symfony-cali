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
            ->select('fr, f, o, fc, ft, fa')
            ->from('AppBundle:FilmRoll', 'fr')
            ->innerJoin('fr.film', 'f')
            ->innerJoin('fr.office', 'o')
            ->leftJoin('fr.filmTransfers', 'ft')
            ->leftJoin('fr.filmRollAdjusts', 'fa')
            ->leftJoin('fr.filmCheckouts', 'fc')
        ;

        return $qb->getQuery()->getResult();
    }

    public function getRollsFromEstimate(Estimate $estimate)
    {
        $filmsIds = $estimate->getIdFilmsRelated();

        if (empty($filmsIds)) {
            return null;
        }

        $manager = $this->getEntityManager();
        $qb = $manager->createQueryBuilder();

        $qb
            ->select('fr, f, o, fc, frt, fa, rw, ft')
            ->from('AppBundle:FilmRoll', 'fr')
            ->innerJoin('fr.film', 'f')
            ->innerJoin('f.filmType', 'ft')
            ->innerJoin('fr.office', 'o')
            ->innerJoin('fr.rollWidth', 'rw')
            ->leftJoin('fr.filmCheckouts', 'fc')
            ->leftJoin('fr.filmTransfers', 'frt')
            ->leftJoin('fr.filmRollAdjusts', 'fa')
            ->where($qb->expr()->in('f.id', $filmsIds))
            ->andWhere('fr.currentWeight > 0')
            ->orderBy('fr.office')
        ;

        return $qb->getQuery()->getResult();
    }
}
