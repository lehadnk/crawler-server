<?php

use Helpers\Distance;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 7:53 AM
 */
class DistanceTest extends PHPUnit_Framework_TestCase
{
    public function testDistance() {
        $this->drawMask();

        $this->assertEquals(Distance::to(1, 1, 1, 1), 0);
        $this->assertEquals(Distance::to(1, 1, 2, 1), 1);
        $this->assertEquals(Distance::to(1, 1, 1, 2), 1);
        $this->assertEquals(Distance::to(1, 1, 10, 1), 9);
        $this->assertEquals(Distance::to(1, 10, 1, 1), 9);
        $this->assertEquals(Distance::to(1, 1, 2, 2), 2);
        $this->assertEquals(Distance::to(1, 1, 3, 3), 4);
    }

    private function drawMask() {
        for($x = 1; $x <= 9; $x++) {
            for ($y = 1; $y <= 9; $y++) {
                echo Distance::to(5, 5, $x, $y);
            }
            echo PHP_EOL;
        }
    }
}
