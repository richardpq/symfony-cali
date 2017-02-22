<?php

namespace AppBundle\Entity\Common;

trait DateTrait
{
    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime $startDate
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime $endDate
     */
    private $endDate;

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     *
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     *
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }
}
