<?php

namespace Helpers;

/**
 * This class is allowing to make time-based operations independent  from the server
 * $loopInterval setting.
 *
 * $loopInterval must be properly configured on the application startup.
 *
 * E.g.:
 * $dotEffect->tickAmount = 5; // Wrong. Will do more or less damage per second depending on the loop interval setting.
 * $dotEffect->timeRemains = Timer::toTickValue(5); // Good. It will be always 5 damage per second no matter what.
 *
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 7:00 AM
 */
class Timer
{
    public static $loopInterval = 0.1;

    /**
     * Calculates the tick amount depending on the server loop interval setting.
     *
     * @param float $value
     * @return float
     */
    public static function toTickValue(float $value) : float {
        return $value / (1 / self::$loopInterval);
    }
}