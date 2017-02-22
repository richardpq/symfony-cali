<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Utils\FilmRollCalculus;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FilmRollRepository")
 * @ORM\Table(name="film_roll")
 * @ORM\HasLifecycleCallbacks()
 */
class FilmRoll
{
    /**
     * @var int $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float $linearFt
     *
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank(groups={"newFilmRoll", "editFilmRoll"})
     */
    private $linearFt;

    /**
     * @var float $coreWeight
     *
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank()
     */
    private $coreWeight;

    /**
     * @var float $fullWeight
     *
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank(groups={"newFilmRoll", "editFilmRoll"})
     */
    private $fullWeight;

    /**
     * @var float $currentWeight
     *
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank(groups={"editFilmRoll"})
     */
    private $currentWeight;

    /**
     * @var float $filmFactor
     *
     * @ORM\Column(type="decimal", precision=5, scale=4)
     * @Assert\NotBlank()
     */
    private $filmFactor;

    /**
     * @var float $totalSqFt
     *
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank()
     */
    private $totalSqFt;

    /**
     * @var string $lot
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $lot;

    /**
     * @var \DateTime $addedAt
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $addedAt;

    /**
     * @var float $cost
     *
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $cost;

    /**
     * @var Film $film
     *
     * @ORM\ManyToOne(targetEntity="Film", inversedBy="filmRolls")
     * @ORM\JoinColumn(name="film_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(groups={"newFilmRoll", "editFilmRoll"})
     */
    private $film;


    /**
     * @var RollWidth $rollWidth
     *
     * @ORM\ManyToOne(targetEntity="RollWidth", inversedBy="filmRolls")
     * @ORM\JoinColumn(name="roll_width_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(groups={"newFilmRoll", "editFilmRoll"})
     */
    private $rollWidth;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->film.' ('.$this->lot.')';
    }

    /**
     *
     * @return array
     */
    public function getLabelInfo()
    {
        $data = [
            'roll' => $this->getId(),
            'manufacturer' => $this->getFilm()->getManufacturer()->getDescription(),
            'name' => $this->getFilm()->getFilmType()->getDescription(),
            'width' => $this->getWidth(),
            'weight' => $this->getCurrentWeight()
        ];

        return $data;
    }


    /**
     * @return float
     */
    public function getCostPerSqFt()
    {
        if ($this->cost) {
            return round($this->cost / $this->totalSqFt, 2);
        }

        return 0.0;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        if ($this->getCurrentWeight() == 0 || $this->getCurrentWeight() == $this->getCoreWeight()) {
            return true;
        }

        return false;
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
     * Set linearFt
     *
     * @param string $linearFt
     *
     * @return FilmRoll
     */
    public function setLinearFt($linearFt)
    {
        $this->linearFt = $linearFt;

        return $this;
    }

    /**
     * Get linearFt
     *
     * @return string
     */
    public function getLinearFt()
    {
        return $this->linearFt;
    }

    /**
     * Set $coreWeight
     *
     * @ORM\PrePersist()
     *
     * @return FilmRoll
     */
    public function setCoreWeight()
    {
        $rollWidth = $this->getRollWidth();

        $coreWeight = $this->getFilm()->getManufacturer()->getCoreWeightByManufacturers()->filter(
            function (CoreWeightByManufacturer $cw) use ($rollWidth) {
                return  $cw->getRollWidth() == $rollWidth;
            }
        )->first();

        if ($coreWeight) {
            $this->coreWeight = $coreWeight->getWeight();
        } else {
            $this->coreWeight = 0.0;
        }

        return $this;
    }

    /**
     * Get $coreWeight
     *
     * @return float
     */
    public function getCoreWeight()
    {
        return $this->coreWeight;
    }

    /**
     * Set fullWeight
     *
     * @param float $fullWeight
     *
     * @return FilmRoll
     */
    public function setFullWeight($fullWeight)
    {
        $this->fullWeight = $fullWeight;

        return $this;
    }

    /**
     * Get fullWeight
     *
     * @return float
     */
    public function getFullWeight()
    {
        return $this->fullWeight;
    }

    /**
     * Set currentWeight
     *
     * @param float $currentWeight
     *
     * @return FilmRoll
     */
    public function setCurrentWeight($currentWeight)
    {
        $this->currentWeight = $currentWeight;

        return $this;
    }

    /**
     * Get currentWeight
     *
     * @return float
     */
    public function getCurrentWeight()
    {
        return $this->currentWeight;
    }

    /**
     * Set filmFactor
     *
     * @param string $filmFactor
     *
     * @return FilmRoll
     */
    public function setFilmFactor($filmFactor)
    {
        $this->filmFactor = $filmFactor;

        return $this;
    }

    /**
     * Get filmFactor
     *
     * @return float
     */
    public function getFilmFactor()
    {
        return $this->filmFactor;
    }

    /**
     * Set totalSqFt
     *
     * @ORM\PrePersist()
     *
     * @return FilmRoll
     */
    public function setCalculatedValues()
    {
        $size = $this->getRollWidth()->getWidth();
        $linearFt = $this->getLinearFt();

        $totalSqFt = FilmRollCalculus::getSquareFeetWithLinear($size, $linearFt);

        $this->totalSqFt = $totalSqFt;
        $this->currentWeight = $this->getFullWeight();
        $this->filmFactor = FilmRollCalculus::getFilmFactor($this->currentWeight, $this->coreWeight, $totalSqFt);


        return $this;
    }

    /**
     * Get totalSqFt
     *
     * @return float
     */
    public function getTotalSqFt()
    {
        return number_format($this->totalSqFt);
    }

    /**
     * @return string
     */
    public function getLot()
    {
        return $this->lot;
    }

    /**
     * @param string $lot
     *
     * @return FilmRoll
     */
    public function setLot($lot)
    {
        $this->lot = $lot;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * Set addedAt
     *
     * @ORM\PrePersist()
     *
     * @return FilmRoll
     */
    public function setAddedAt()
    {
        $this->addedAt = new \DateTime();

        return $this;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     *
     * @return FilmRoll
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Set film
     *
     * @param \AppBundle\Entity\Film $film
     *
     * @return FilmRoll
     */
    public function setFilm(Film $film)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \AppBundle\Entity\Film
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set rollWidth
     *
     * @param RollWidth $rollWidth
     *
     * @return FilmRoll
     */
    public function setRollWidth(RollWidth $rollWidth)
    {
        $this->rollWidth = $rollWidth;

        return $this;
    }

    /**
     * Get rollWidth
     *
     * @return RollWidth
     */
    public function getRollWidth()
    {
        return $this->rollWidth;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->getRollWidth()->getWidth();
    }

    /**
     * Set totalSqFt
     *
     * @param string $totalSqFt
     *
     * @return FilmRoll
     */
    public function setTotalSqFt($totalSqFt)
    {
        $this->totalSqFt = $totalSqFt;

        return $this;
    }
}
