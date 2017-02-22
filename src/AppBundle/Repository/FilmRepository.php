<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FilmRepository extends EntityRepository
{
    /*public function findAll($justQueryBuilder = false, $excludeDiscontinued = true)
    {
        $manager = $this->getEntityManager();
        $qb = $manager->createQueryBuilder();

        $qb
            ->select('f, ft, fm')
            ->from('AppBundle:Film', 'f')
            ->innerJoin('f.filmType', 'ft')
            ->innerJoin('f.manufacturer', 'fm')
            ->orderBy('fm.description, ft.description')
        ;

        if ($excludeDiscontinued) {
            $qb->where('f.discontinued = false');
        }

        if ($justQueryBuilder) {
            return $qb;
        }

        return $qb->getQuery()->getResult();
    }*/

    public function getFilmsThatHasPrice($justQueryBuilder = false, $excludeDiscontinued = true)
    {
        $manager = $this->getEntityManager();
        $qb = $manager->createQueryBuilder();

        $qb
            ->select('f')
            ->from('AppBundle:Film', 'f')
            ->innerJoin('f.filmType', 'ft')
            ->innerJoin('f.manufacturer', 'fm')
            ->innerJoin('f.filmPrices', 'fp')
            ->orderBy('fm.description, ft.description')
        ;

        if ($excludeDiscontinued) {
            $qb->where('f.discontinued = false');
        }

        if ($justQueryBuilder) {
            return $qb;
        }

        return $qb->getQuery()->getResult();
    }
}
