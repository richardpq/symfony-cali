<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="roll_width")
 * @UniqueEntity("width")
 */
class RollWidth
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", unique=true)
     * @Assert\NotBlank()
     */
    private $width;

    /**
     * @ORM\OneToMany(targetEntity="FilmRoll", mappedBy="rollWidth")
     */
    private $filmRolls;

    /**
     * @ORM\OneToMany(targetEntity="CoreWeightByManufacturer", mappedBy="rollWidth")
     */
    private $coreWeightByManufacturers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filmRolls = new ArrayCollection();
        $this->coreWeightByManufacturers = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->width;
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
     * Set width
     *
     * @param integer $width
     *
     * @return RollWidth
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Add filmRoll
     *
     * @param FilmRoll $filmRoll
     *
     * @return RollWidth
     */
    public function addFilmRoll(FilmRoll $filmRoll)
    {
        $this->filmRolls[] = $filmRoll;

        return $this;
    }

    /**
     * Remove filmRoll
     *
     * @param FilmRoll $filmRoll
     */
    public function removeFilmRoll(FilmRoll $filmRoll)
    {
        $this->filmRolls->removeElement($filmRoll);
    }

    /**
     * Get filmRolls
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmRolls()
    {
        return $this->filmRolls;
    }

    /**
     * Add coreWeightByManufacturer
     *
     * @param CoreWeightByManufacturer $coreWeightByManufacturer
     *
     * @return RollWidth
     */
    public function addCoreWeightByManufacturer(CoreWeightByManufacturer $coreWeightByManufacturer)
    {
        $this->coreWeightByManufacturers[] = $coreWeightByManufacturer;

        return $this;
    }

    /**
     * Remove coreWeightByManufacturer
     *
     * @param CoreWeightByManufacturer $coreWeightByManufacturer
     */
    public function removeCoreWeightByManufacturer(CoreWeightByManufacturer $coreWeightByManufacturer)
    {
        $this->coreWeightByManufacturers->removeElement($coreWeightByManufacturer);
    }

    /**
     * Get coreWeightByManufacturers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoreWeightByManufacturers()
    {
        return $this->coreWeightByManufacturers;
    }
}
