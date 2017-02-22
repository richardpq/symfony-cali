<?php

namespace AppBundle\DataFixtures\ORM\BaseData;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\CoreWeightByManufacturer;

class Load68CoreWeightData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            '3M' => [
                '40' => '1.05',
                '48' => '1.25',
                '50' => '1.30',
                '60' => '1.60',
                '72' => '1.85',
                ],
            'Arlon' => ['24' => '0.60'],
            'ASWF' => [
                '36' => '1.00',
                '48' => '1.25',
                '60' => '1.75',
                '72' => '1.80',
                ],
            'Datex' => [
                '36' => '1.00',
                '48' => '1.25',
                '60' => '1.75',
                ],
            'Hanita' => [
                '48' => '1.50',
                '60' => '1.75',
                '72' => '2.00',
                ],
            'Huper' => [
                '36' => '1.00',
                '48' => '1.25',
                '60' => '1.75',
                '72' => '1.80',
                ],
            'Lintec' =>[
                '60' => '2.85',
                '61' => '3.55',
                ],
            'Llumar' =>[
                '36' => '1.00',
                '48' => '1.25',
                '60' => '1.75',
                '72' => '1.80',
                ],
            'Madico' => [
                '36' => '1.00',
                '48' => '1.25',
                '60' => '1.75',
                '72' => '1.80',
                ],
            'MaxPro' => [
                '60' => '1.55',
                ],
            'Solar Gard' => [
                '24' => '0.60',
                '36' => '1.00',
                '48' => '1.25',
                '60' => '1.75',
                '72' => '1.80',
                ],
            'Solyx' => [
                '30' => '1.10',
                '36' => '1.00',
                '48' => '1.25',
                '60' => '1.75',
                '72' => '1.80',
                ],
            'SunTek' => [
                '36' => '1.00',
                '48' => '1.25',
                '60' => '1.75',
                '72' => '1.80'
                ],
            'Vista' => [
                '36' => '1.00',
                '48' => '1.25',
                '60' => '1.75',
                '72' => '1.80',
                ],
            'Solar Art' => [
                '60' => '0.00'
            ]
        ];

        foreach ($data as $manufacturer => $info) {
            foreach ($info as $width => $weight) {
                $coreWeightByManufacturer = new CoreWeightByManufacturer();
                $coreWeightByManufacturer
                    ->setManufacturer(
                        $this->getReference('manufacturer-'.str_replace(' ', '-', strtolower($manufacturer)))
                    )
                    ->setRollWidth($this->getReference('roll-width-'.$width))
                    ->setWeight($weight)
                ;

                $manager->persist($coreWeightByManufacturer);
            }
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 68;
    }
}
