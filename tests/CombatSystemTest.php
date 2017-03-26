<?php

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 26/03/2017
 * Time: 4:40 AM
 */
class CombatSystemTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Game\World\Map
     */
    private $map;
    /**
     * @var \Game\Entity\Creature
     */
    private $fighter1;
    /**
     * @var \Game\Entity\Creature
     */
    private $fighter2;

    public function setUp() {
        $this->map = new \Game\World\Map();
        $this->map->load(__DIR__.'/data/maps/map.php', false);

        $this->fighter1 = new \Game\Entity\Creature();
        $this->fighter1->attackPower = 5;
        $this->fighter1->spawn($this->map, 1, 1);
        $this->fighter2 = new \Game\Entity\Creature();
        $this->fighter2->spawn($this->map, 2, 1);
    }

    public function testHit() {
        $hp = $this->fighter2->getHp();
        $this->fighter1->hit($this->fighter2, 5);
        $this->assertEquals($this->fighter2->getHp(), $hp - 5);
    }

    public function testSwing() {
        $hp = $this->fighter2->getHp();
        $this->fighter1->direction = DIRECTION_RIGHT;
        $this->fighter1->swing();
        $this->assertEquals($this->fighter2->getHp(), $hp - 5);
    }
}
