<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * @ORM\Entity()
 * @UniqueEntity("description")
 */
class Manufacturer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=90, unique=true)
     * @Assert\NotBlank()
     *
     * @var string $description
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Film", mappedBy="manufacturer")
     */
    private $films;

    /**
     * @ORM\OneToMany(targetEntity="CoreWeightByManufacturer", mappedBy="manufacturer")
     */
    private $coreWeightByManufacturers;

    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->coreWeightByManufacturers = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Manufacturer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Add film
     *
     * @param \AppBundle\Entity\Film $film
     *
     * @return Manufacturer
     */
    public function addFilm(Film $film)
    {
        $this->films[] = $film;

        return $this;
    }

    /**
     * Remove film
     *
     * @param Film $film
     */
    public function removeFilm(Film $film)
    {
        $this->films->removeElement($film);
    }

    /**
     * Get films
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilms()
    {
        return $this->films;
    }

    /**
     * Add coreWeightByManufacturer
     *
     * @param CoreWeightByManufacturer $coreWeightByManufacturer
     *
     * @return Manufacturer
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
