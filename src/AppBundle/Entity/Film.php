<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FilmRepository")
 * @ORM\Table(name="film", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="film_idx", columns={"manufacturer_id", "film_type_id"})})
 * @UniqueEntity(
 *     fields={"manufacturer", "filmType"},
 *     message="This Manufacturer already has this Film type."
 * )
 */
class Film
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
     * @ORM\Column(type="boolean")
     *
     * @var boolean $description
     */
    private $discontinued = false;

    /**
     * @ORM\ManyToOne(targetEntity="Manufacturer", inversedBy="films", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false, name="manufacturer_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity="FilmType", inversedBy="films", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false, name="film_type_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $filmType;

    /**
     * @ORM\OneToMany(targetEntity="FilmPrice", mappedBy="film")
     * @ORM\OrderBy({"endDate" = "DESC"})
     */
    private $filmPrices;

    /**
     * @ORM\OneToMany(targetEntity="FilmRoll", mappedBy="film")
     */
    private $filmRolls;

    public function __construct()
    {
        $this->filmPrices = new ArrayCollection();
        $this->filmRolls = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->manufacturer.'-'.$this->filmType;
    }

    /**
     * @return FilmPrice|null
     */
    public function getActualFilmPrice()
    {
        foreach ($this->getFilmPrices() as $filmPrice) {
            /** @var FilmPrice $filmPrice */
            if (!$filmPrice->getEndDate()) {
                return $filmPrice;
            }
        }

        return null;
    }

    /**
     * @return float
     */
    public function getActualSquareFeetPrice()
    {
        return $this->getActualFilmPrice() ? $this->getActualFilmPrice()->getSqftPrice() : 0.00;
    }

    /**
     * @return float
     */
    public function getActualFrenchPanePrice()
    {
        return $this->getActualFilmPrice() ? $this->getActualFilmPrice()->getFrenchPanesPrice() : 0.00;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function isDiscontinued()
    {
        return $this->discontinued;
    }

    /**
     * @param boolean $discontinued
     *
     * @return Film
     */
    public function setDiscontinued($discontinued)
    {
        $this->discontinued = $discontinued;

        return $this;
    }

    /**
     * @return Manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @param Manufacturer $manufacturer
     *
     * @return Film
     */
    public function setManufacturer(Manufacturer $manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * @return FilmType
     */
    public function getFilmType()
    {
        return $this->filmType;
    }

    /**
     * @param FilmType $filmType
     *
     * @return Film
     */
    public function setFilmType(FilmType $filmType)
    {
        $this->filmType = $filmType;

        return $this;
    }

    /**
     * Add filmPrice
     *
     * @param FilmPrice $filmPrice
     *
     * @return Film
     */
    public function addFilmPrice(FilmPrice $filmPrice)
    {
        $this->filmPrices[] = $filmPrice;

        return $this;
    }

    /**
     * Remove filmPrice
     *
     * @param FilmPrice $filmPrice
     */
    public function removeFilmPrice(FilmPrice $filmPrice)
    {
        $this->filmPrices->removeElement($filmPrice);
    }

    /**
     * Get filmPrices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmPrices()
    {
        return $this->filmPrices;
    }

    /**
     * Add filmRoll
     *
     * @param FilmRoll $filmRoll
     *
     * @return Film
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
}
