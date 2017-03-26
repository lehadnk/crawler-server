<?php
namespace Game\Entity;

use Game\World\Map;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 8:30 AM
 */
class Base
{
    public $x = 0;
    public $y = 0;

    public $direction = DIRECTION_RIGHT;

    /**
     * @var Map
     */
    public $map;

    public $id;

    public function __construct()
    {
        $this->id = uniqid();
    }

    public function spawn(Map $map, $x, $y)
    {
        $map->addCreature($this);
        $this->x = $x;
        $this->y = $y;
        $map->getTile($x, $y)->actors->attach($this);
    }

    public function getMap()
    {
        return $this->map;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setX($x)
    {
        $this->x = $x;
    }

    public function setY($y)
    {
        $this->y = $y;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDirection($direction)
    {
        if (!in_array($direction, [
            DIRECTION_UP, DIRECTION_DOWN,
            DIRECTION_LEFT, DIRECTION_RIGHT
        ])) throw new \Exception("Direction cannot be $direction!");

        $this->direction = $direction;
    }

    public function getDirection()
    {
        return $this->direction;
    }
}