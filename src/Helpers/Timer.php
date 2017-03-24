<?php

namespace Helpers;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 7:00 AM
 */
class Timer
{
    public static $loopInterval = 0.1;

    public static function toTickValue(float $value) {
        return $value / (1 / self::$loopInterval);
    }
}