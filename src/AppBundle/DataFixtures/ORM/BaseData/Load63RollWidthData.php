<?php

namespace AppBundle\DataFixtures\ORM\BaseData;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\RollWidth;

class Load63RollWidthData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $widths = ['24', '30', '35', '36', '40', '48', '50', '54', '60', '61', '72'];

        foreach ($widths as $width) {
            $rollWidth = new RollWidth();
            $rollWidth->setWidth($width);

            $manager->persist($rollWidth);
            $this->addReference('roll-width-'.$width, $rollWidth);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 63;
    }
}
