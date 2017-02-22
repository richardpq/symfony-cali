<?php

namespace AppBundle\Form\Transformer;

use AppBundle\Entity\CommercialEntity;
use AppBundle\Entity\Person;
use AppBundle\Entity\PersonType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CommercialEntityTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


    /**
     * @param CommercialEntity|null $value
     *
     * @return string
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        return $value->getName();
    }

    /**
     * @inheritDoc
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            throw new TransformationFailedException('Name cannot be empty');
        }

        $commercialPersonType = $this->manager->getRepository('AppBundle:PersonType')
            ->find(PersonType::COMMERCIAL_ENTITY);
        $matt = $this->manager->getRepository('AppBundle:NaturalPerson')->findOneBy([
            'name' => 'Matthew',
            'lastName' => 'Darienzo'
        ]);

        $person = new Person();
        $person->setPersonType($commercialPersonType);
        $this->manager->persist($person);
        $this->manager->flush();

        $commercialEntity = new CommercialEntity();
        $commercialEntity
            ->setPerson($person)
            ->setName($value)
            ->setContactPerson($matt)
        ;

        $this->manager->persist($commercialEntity);
        $this->manager->flush();

        return $commercialEntity;
    }
}
