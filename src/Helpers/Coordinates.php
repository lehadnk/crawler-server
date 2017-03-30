<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 9:43 AM
 */

namespace Helpers;

/**
 * This class contains some helper methods to work with coordinates.
 * @package Helpers
 */
class Coordinates
{
    /**
     * Returns the array of coordinates of a tile $distance away from the $x, $y in the said $direction.
     *
     * @param $x
     * @param $y
     * @param $direction
     * @param int $distance
     * @return array
     */
    public static function vector($x, $y, $direction, $distance = 1) : array {
        switch ($direction) {
            case DIRECTION_UP:
                $y -= $distance;
                break;
            case DIRECTION_DOWN:
                $y += $distance;
                break;
            case DIRECTION_LEFT:
                $x -= $distance;
                break;
            case DIRECTION_RIGHT:
                $x += $distance;
                break;
        }

        return [$x, $y];
    }
}