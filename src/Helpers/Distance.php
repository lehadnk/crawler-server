<?php

namespace Helpers;

/**
 * This class contains a helper methods to calculate the distance between tiles and objects.
 *
 * User: lehadnk
 * Date: 24/03/2017
 */
class Distance
{
    /**
     * Calculates the distance between two tiles.
     *
     * @param $fromX
     * @param $fromY
     * @param $toX
     * @param $toY
     * @return integer
     */
    public static function to($fromX, $fromY, $toX, $toY) : integer {
        $modX = ($fromX > $toX) ? $fromX - $toX : $toX - $fromX;
        $modY = ($fromY > $toY) ? $fromY - $toY : $toY - $fromY;

        return $modX + $modY;
    }
}