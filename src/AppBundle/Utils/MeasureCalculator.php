<?php

namespace AppBundle\Utils;

class MeasureCalculator
{
    /**
     * @param float $width
     * @param float $length
     * @param boolean $round
     *
     * @return float
     */
    public static function squareFeetFromInches($width, $length, $round = false)
    {
        $result = (float)($width * $length) / 144;

        if ($round) {
            return round($result);
        }

        return $result;
    }

    /**
     * @param float $width
     * @param float $length
     * @param bool  $round
     *
     * @return float
     */
    public static function linearFootFromInches($width, $length, $round = false)
    {
        $result = (float)(($width + $length) * 2) / 12;

        if ($round) {
            return round($result);
        }

        return $result;
    }
}
