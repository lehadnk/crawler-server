<?php

namespace Helpers;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 7:48 AM
 */
class Distance
{
    public static function to($fromX, $fromY, $toX, $toY) {
        $modX = ($fromX > $toX) ? $fromX - $toX : $toX - $fromX;
        $modY = ($fromY > $toY) ? $fromY - $toY : $toY - $fromY;

        return $modX + $modY;
    }
}