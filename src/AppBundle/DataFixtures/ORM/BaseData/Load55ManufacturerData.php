<?php

namespace AppBundle\DataFixtures\ORM\BaseData;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Manufacturer;

class Load55ManufacturerData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $manufacturers = [
            '3M',
            'Arlon',
            'ASWF',
            'Avery',
            'Clear Focus',
            'Datex',
            'Di-Noc',
            'General Formulations',
            'Hanita',
            'Huper',
            'Johnson',
            'Lintec',
            'Llumar',
            'Mactac',
            'Madico',
            'MaxPro',
            'Oracal',
            'Pentagon',
            'Permagloss',
            'Rtape',
            'Solar Art',
            'Solar Gard',
            'Solar Graphics',
            'Solyx',
            'Suntek',
            'View',
            'Vista',
            'VKool',
            'Wintech',
        ];

        foreach ($manufacturers as $manufacturer) {
            $manufacturerObj = new Manufacturer();
            $manufacturerObj->setDescription($manufacturer);

            $manager->persist($manufacturerObj);
            $this->addReference('manufacturer-'.str_replace(' ', '-', strtolower($manufacturer)), $manufacturerObj);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 55;
    }
}
