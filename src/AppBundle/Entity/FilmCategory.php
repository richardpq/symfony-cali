<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="film_category")
 * @UniqueEntity("description")
 */
class FilmCategory
{
    const FILM_CATEGORY_SOLAR = 1;
    const FILM_CATEGORY_GRAFFITI = 2;
    const FILM_CATEGORY_GRAPHICS = 3;
    const FILM_CATEGORY_SECURITY = 4;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, unique=true)
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="FilmType", mappedBy="filmCategory")
     */
    private $filmTypes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filmTypes = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->description;
    }

    /**
     * @param $id
     *
     * @return FilmCategory
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set description
     *
     * @param string $description
     *
     * @return FilmCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add film
     *
     * @param \AppBundle\Entity\FilmType $filmType
     *
     * @return FilmCategory
     */
    public function addFilmType(FilmType $filmType)
    {
        $this->filmTypes[] = $filmType;

        return $this;
    }

    /**
     * Remove film
     *
     * @param FilmType $filmType
     */
    public function removeFilmType(FilmType $filmType)
    {
        $this->filmTypes->removeElement($filmType);
    }

    /**
     * Get films
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmTypes()
    {
        return $this->filmTypes;
    }
}
