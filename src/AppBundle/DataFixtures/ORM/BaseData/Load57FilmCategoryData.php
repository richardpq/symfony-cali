<?php

namespace AppBundle\DataFixtures\ORM\BaseData;

use AppBundle\Entity\FilmCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Load57FilmCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $categories = [
            FilmCategory::FILM_CATEGORY_SOLAR => 'Solar',
            FilmCategory::FILM_CATEGORY_GRAFFITI => 'Graffiti',
            FilmCategory::FILM_CATEGORY_GRAPHICS => 'Graphics',
            FilmCategory::FILM_CATEGORY_SECURITY => 'Security'
        ];

        foreach ($categories as $index => $category) {
            $filmCategory = new FilmCategory();
            $filmCategory
                ->setId($index)
                ->setDescription($category)
            ;

            $manager->persist($filmCategory);
            $this->addReference('category-'.str_replace(' ', '-', strtolower($category)), $filmCategory);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 57;
    }
}
