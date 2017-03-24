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
        $direction = rand(1, 4);
        $this->actor->step($direction);
    }
}