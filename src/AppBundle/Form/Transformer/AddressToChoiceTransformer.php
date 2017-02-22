<?php

namespace AppBundle\Form\Transformer;

use AppBundle\Entity\Address;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class AddressToChoiceTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


    /**
     * @param Address $value
     *
     * @return array|string
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        $key = (string) $value;
        return [ $key => $value->getId()];
    }

    /**
     * @inheritDoc
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            throw new TransformationFailedException('Address cannot be empty');
        }

        $address = $this->manager->getRepository('AppBundle:Address')->find($value);

        if (null === $address) {
            throw new TransformationFailedException('Address not found');
        }

        return $address;
    }
}
