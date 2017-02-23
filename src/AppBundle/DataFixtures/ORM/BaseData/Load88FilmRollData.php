<?php

namespace AppBundle\DataFixtures\ORM\BaseData;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\FilmRoll;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;

class Load88FilmRollData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $oldDBConnection = $this->container->get('doctrine.dbal.old_db_connection');

        $sql = "SELECT * FROM FilmRoll WHERE CurrentWeight > EmptyWeight;";
        $stmt = $oldDBConnection->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll();

        foreach ($rows as $row) {
            $row['Product'] = str_ireplace('Discontinued', '', $row['Product']);
            $row['Product'] = str_ireplace('Graffitigard', 'Graffiti', $row['Product']);
            $row['Product'] = str_ireplace('MIL SEC.', 'Mil Security', $row['Product']);
            $row['Product'] = str_ireplace('MIL', 'Mil', $row['Product']);
            $row['Product'] = str_ireplace('4MIL', '4 Mil', $row['Product']);
            $row['Product'] = str_ireplace('2MIL', '2 Mil', $row['Product']);
            //$row['FilmType'] = str_replace('-', '', $row['FilmType']);
            $row['Product'] = trim($row['Product']);
            $row['Product'] = trim($row['Product'], '-');

            try {
                $rollWidth = $this->getReference('roll-width-'.str_replace(' ', '-', strtolower(trim($row['Width']))));
            } catch (\Exception $e) {
                $rollWidth = null;
            }

            try {
                $filmName = $row['Manufacturer'].'-'.$row['Product'];
                $film = $this->getReference('film-'.str_replace(' ', '-', strtolower(trim($filmName))));
            } catch (\Exception $e) {
                $film = null;
            }

            if ($rollWidth && $film && $row['LinearFeet'] > 0) {
                $filmRoll = new FilmRoll();
                $filmRoll
                    ->setId($row['ID'])
                    ->setCurrentWeight($row['CurrentWeight'])
                    ->setLinearFt($row['LinearFeet'])
                    ->setFullWeight($row['FullWeight'])
                    ->setFilmFactor($row['FilmFactor'])
                    ->setLot($row['Lot'])
                    ->setTotalSqFt($row['SqFt'])
                    ->setRollWidth($rollWidth)
                    ->setFilm($film)
                ;

                $manager->persist($filmRoll);
            } else {

            }
        }

        $manager->flush();

    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 88;
    }
}
