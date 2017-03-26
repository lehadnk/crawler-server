<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 26/03/2017
 * Time: 4:28 AM
 */

namespace Traits;

use Game\World\Map;
use Helpers\Coordinates;
use Interfaces\Vulnerable;

trait Attacker
{
    public $attackPower = 1;

    /**
     * @return Map
     */
    abstract function getMap();
    abstract function getDirection();

    public function hit(Vulnerable $target, $damage)
    {
        $target->recieveDamage($damage);
    }

    public function swing() {
        list($x, $y) = Coordinates::direction($this->getX(), $this->getY(), $this->direction);
        if ($this->getMap()->isTileExists($x, $y)) {
            if (count($this->getMap()->getTile($x, $y)->actors) > 0) {
                $this->getMap()->getTile($x, $y)->actors->rewind();
                $actor = $this->getMap()->getTile($x, $y)->actors->current();
                $this->hit($actor, $this->attackPower);
            }
        }
    }
}