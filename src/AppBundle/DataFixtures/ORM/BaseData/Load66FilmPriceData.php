<?php

namespace AppBundle\DataFixtures\ORM\BaseData;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use AppBundle\Entity\FilmPrice;

class Load66FilmPriceData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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


        $sql = "SELECT FilmID, Manufacturer, FilmType, Level3, Panes3 FROM solar_old.film;";
        $stmt = $oldDBConnection->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll();

        foreach ($rows as $row) {
            $row['FilmType'] = str_ireplace('Discontinued', '', $row['FilmType']);
            $row['FilmType'] = str_ireplace('Graffitigard', 'Graffiti', $row['FilmType']);
            $row['FilmType'] = str_ireplace('MIL SEC.', 'Mil Security', $row['FilmType']);
            $row['FilmType'] = str_ireplace('MIL', 'Mil', $row['FilmType']);
            $row['FilmType'] = str_ireplace('4MIL', '4 Mil', $row['FilmType']);
            $row['FilmType'] = str_ireplace('2MIL', '2 Mil', $row['FilmType']);
            //$row['FilmType'] = str_replace('-', '', $row['FilmType']);
            $row['FilmType'] = trim($row['FilmType']);
            $row['FilmType'] = trim($row['FilmType'], '-');
            $row['Manufacturer'] = trim($row['Manufacturer']);
            $row['Manufacturer'] = trim($row['Manufacturer'], '-');

            try {
                $filmName = $row['Manufacturer'].'-'.$row['FilmType'];
                $film = $this->getReference('film-'.str_replace(' ', '-', strtolower(trim($filmName))));
            } catch (\Exception $e) {
                $film = null;
            }

            if ($film) {
                $filmPrice = new FilmPrice();
                $filmPrice
                    ->setFilm($film)
                    ->setSqftPrice($row['Level3'])
                    ->setFrenchPanesPrice($row['Panes3'])
                ;

                $manager->persist($filmPrice);
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
        return 66;
    }
}
