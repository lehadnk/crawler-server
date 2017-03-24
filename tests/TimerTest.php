<?php

use Helpers\Timer;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 11:10 AM
 */
class TimerTest extends PHPUnit_Framework_TestCase
{
    public function testTimer() {
        Timer::$loopInterval = 0.1;
        $this->assertEquals(0.2, Timer::toTickValue(2));
    }
}
