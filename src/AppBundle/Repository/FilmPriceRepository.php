<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Film;
use Doctrine\ORM\EntityRepository;

class FilmPriceRepository extends EntityRepository
{
    public function findAll($includeDiscontinued = false)
    {
        $manager = $this->getEntityManager();
        $qb = $manager->createQueryBuilder();

        $qb
            ->select('fp, f')
            ->from('AppBundle:FilmPrice', 'fp')
            ->innerJoin('fp.film', 'f')
            ->where($qb->expr()->isNull('fp.endDate'))
            ->orderBy('fp.film')
        ;

        if (!$includeDiscontinued) {
            $qb
                ->andWhere('f.discontinued =:discontinued')
                ->setParameter('discontinued', $includeDiscontinued)
            ;
        } else {
            $qb
                ->andWhere($qb->expr()->orX(
                    $qb->expr()->eq('f.discontinued', true),
                    $qb->expr()->eq('f.discontinued', false)
                ))
            ;
        }

        return $qb->getQuery()->getResult();
    }

    public function findExistingNoDeprecated(Film $film)
    {
        $manager = $this->getEntityManager();
        $qb = $manager->createQueryBuilder();

        $qb
            ->select('fp')
            ->from('AppBundle:FilmPrice', 'fp')
            ->innerJoin('fp.film', 'f')
            ->where($qb->expr()->isNull('fp.endDate'))
            ->andWhere($qb->expr()->eq('f.id', $film->getId()))
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
