<?php

namespace AppBundle\Utils;

class FilmRollCalculus
{
    /**
     * @param $size
     * @param $linearFt
     *
     * @return float
     */
    public static function getSquareFeetWithLinear($size, $linearFt)
    {
        return ((float)($size/12.0) * $linearFt);
    }

    /**
     * @param $currentWeight
     * @param $coreWeight
     * @param $filmFactor
     *
     * @return float
     */
    public static function getSquareFeetWithFilmFactor($currentWeight, $coreWeight, $filmFactor)
    {
        return ceil(((float)($currentWeight -  $coreWeight) / $filmFactor));
    }

    /**
     * @param $currentWeight
     * @param $coreWeight
     * @param $sqFt
     *
     * @return float
     */
    public static function getFilmFactor($currentWeight, $coreWeight, $sqFt)
    {
        return ((float)($currentWeight - $coreWeight) / $sqFt);
    }

    /**
     * @param $sqFt
     * @param $size
     *
     * @return float
     */
    public static function getLinearFeet($sqFt, $size)
    {
        return floor((float)($sqFt/($size/12)));
    }
}
