<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 9:43 AM
 */

namespace Helpers;


class Coordinates
{
    public static function direction($x, $y, $direction, $distance = 1) {
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