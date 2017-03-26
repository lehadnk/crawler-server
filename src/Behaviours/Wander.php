<?php

namespace Behaviours;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 9:21 AM
 */
class Wander extends Base
{
    public function loop() {
        $direction = rand(0, 3);
        $direction = [DIRECTION_UP, DIRECTION_RIGHT, DIRECTION_LEFT, DIRECTION_RIGHT][$direction];
        $this->actor->step($direction);
    }
}