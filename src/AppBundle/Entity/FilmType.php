<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity()
 * @UniqueEntity("description")
 */
class FilmType
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
     * @ORM\Column(type="string", length=45, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 45,
     *      maxMessage = "Description cannot be longer than {{ limit }} characters"
     * )
     *
     * @var string $description
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Film", mappedBy="filmType")
     */
    private $films;

    /**
     * @var FilmCategory
     *
     * @ORM\ManyToOne(targetEntity="FilmCategory", inversedBy="filmTypes")
     * @ORM\JoinColumn(name="film_category_id", referencedColumnName="id", nullable=false)
     */
    private $filmCategory;

    /**
     * FilmType constructor.
     */
    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return FilmType
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
     * @return FilmType
     */
    public function addFilm(Film $film)
    {
        $this->films[] = $film;

        return $this;
    }

    /**
     * Remove film
     *
     * @param \AppBundle\Entity\Film $film
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
     * Set filmCategory
     *
     * @param FilmCategory $filmCategory
     *
     * @return FilmType
     */
    public function setFilmCategory(FilmCategory $filmCategory)
    {
        $this->filmCategory = $filmCategory;

        return $this;
    }

    /**
     * Get filmCategory
     *
     * @return \AppBundle\Entity\FilmCategory
     */
    public function getFilmCategory()
    {
        return $this->filmCategory;
    }
}
