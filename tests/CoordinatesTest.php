<?php

use Helpers\Coordinates;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 11:07 AM
 */
class CoordinatesTest extends PHPUnit_Framework_TestCase
{
    public function testCoordinates() {
        $this->assertEquals(['3', '5'], Coordinates::direction('2', '5', DIRECTION_RIGHT));
        $this->assertEquals(['3', '10'], Coordinates::direction('3', '5', DIRECTION_DOWN, 5));
    }
}
