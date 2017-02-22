<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Common\DateTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FilmPriceRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class FilmPrice
{
    use DateTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     * @Assert\NotBlank()
     *
     * @var string $sqftPrice
     */
    private $sqftPrice;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     * @Assert\NotBlank()
     *
     * @var string $frenchPanesPrice
     */
    private $frenchPanesPrice;

    /**
     * @ORM\ManyToOne(targetEntity="Film", inversedBy="filmPrices")
     * @ORM\JoinColumn(nullable=false, name="film_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $film;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->film;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getSqftPrice()
    {
        return $this->sqftPrice;
    }

    /**
     * @param float $sqftPrice
     *
     * @return FilmPrice
     */
    public function setSqftPrice($sqftPrice)
    {
        $this->sqftPrice = $sqftPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getFrenchPanesPrice()
    {
        return $this->frenchPanesPrice;
    }

    /**
     * @param float $frenchPanesPrice
     *
     * @return FilmPrice
     */
    public function setFrenchPanesPrice($frenchPanesPrice)
    {
        $this->frenchPanesPrice = $frenchPanesPrice;
        return $this;
    }

    /**
     * @return Film
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * @param Film $film
     *
     * @return FilmPrice
     */
    public function setFilm(Film $film)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     *
     * @return DateTrait
     */
    public function setStartDate()
    {
        $this->startDate = new \DateTime();

        return $this;
    }
}
