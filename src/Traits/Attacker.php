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

/**
 * Trait Attacker
 *
 * This trait defines the attacker entity, meaning the actor implementing it
 * could do melee damage to the other Vulnerable targets.
 *
 * @see Vulnerable
 *
 * @package Traits
 */
trait Attacker
{
    /**
     * @var int Attack power of the target. Right now it's just an amount of HP
     * it strikes for with every tick. Yes, this simple.
     */
    public $attackPower = 1;

    /**
     * Returns the map of the actor.
     * @return Map
     */
    abstract function getMap();

    /**
     * Returns the direction of the actor.
     * @return mixed
     */
    abstract function getDirection();

    /**
     * Hits the target.
     * @param Vulnerable $target
     * @param $damage
     */
    public function hit(Vulnerable $target, $damage)
    {
        $target->recieveDamage($damage);
    }

    /**
     * Swings in the current direction, damaging all the Vulnerable targets in
     * front of this actor.
     */
    public function swing() {
        list($x, $y) = Coordinates::vector($this->getX(), $this->getY(), $this->direction);
        if ($this->getMap()->isTileExists($x, $y)) {
            if (count($this->getMap()->getTile($x, $y)->actors) > 0) {
                $this->getMap()->getTile($x, $y)->actors->rewind();
                $actor = $this->getMap()->getTile($x, $y)->actors->current();
                $this->hit($actor, $this->attackPower);
            }
        }
    }
}