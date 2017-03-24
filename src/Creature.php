<?php

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 7:24 AM
 */
class Creature extends Entity
{
    use \Traits\Movable;

    public $speed = 0.4;
    public $sign = 'c';

    /**
     * @var \Behaviours\Base
     */
    public $behaviour;

    public function getMovementCooldown() {
        return 1 / $this->speed;
    }

    public function destroy() {
        foreach ($this->map->creatures as $key => $creature) {
            if ($creature == $this) {
                unset($this->map->creatures[$key]);
            }
        }
    }
}