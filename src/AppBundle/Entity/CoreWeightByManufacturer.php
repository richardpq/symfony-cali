<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="core_weight_by_manufacturer")
 * @UniqueEntity(
 *     fields={"manufacturer", "rollWidth"},
 *     message="This Manufacturer already has this Roll width."
 * )
 */
class CoreWeightByManufacturer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=2)
     * @Assert\NotBlank()
     */
    private $weight;

    /**
     * @var Manufacturer $manufacturer
     *
     * @ORM\ManyToOne(targetEntity="Manufacturer", inversedBy="coreWeightByManufacturers", fetch="EAGER")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $manufacturer;

    /**
     * @var RollWidth
     *
     * @ORM\ManyToOne(targetEntity="RollWidth", inversedBy="coreWeightByManufacturers", fetch="EAGER")
     * @ORM\JoinColumn(name="roll_width_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $rollWidth;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getManufacturer().' - '.$this->getRollWidth();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return CoreWeightByManufacturer
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set manufacturer
     *
     * @param \AppBundle\Entity\Manufacturer $manufacturer
     *
     * @return CoreWeightByManufacturer
     */
    public function setManufacturer(Manufacturer $manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return \AppBundle\Entity\Manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set rollWidth
     *
     * @param \AppBundle\Entity\RollWidth $rollWidth
     *
     * @return CoreWeightByManufacturer
     */
    public function setRollWidth(RollWidth $rollWidth)
    {
        $this->rollWidth = $rollWidth;

        return $this;
    }

    /**
     * Get rollWidth
     *
     * @return \AppBundle\Entity\RollWidth
     */
    public function getRollWidth()
    {
        return $this->rollWidth;
    }
}
