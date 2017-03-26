<?php

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 26/03/2017
 * Time: 8:44 PM
 */
class TileTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Game\World\Map
     */
    private $map;

    public function setUp() {
        $this->map = new \Game\World\Map();
        $this->map->load(__DIR__.'/data/maps/map.php', false);
    }

    public function testCreate() {
        $creature = new \Game\Entity\Creature();
        $creature->spawn($this->map, 1, 1);
        $this->assertEquals(true, $this->map->getTile(1, 1)->actors->contains($creature));
        $creature->move(1, 2);
        $this->assertEquals(true, $this->map->getTile(1, 2)->actors->contains($creature));
        $this->assertEquals(false, $this->map->getTile(1, 1)->actors->contains($creature));
    }
}
