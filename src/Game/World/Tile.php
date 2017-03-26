<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 26/03/2017
 * Time: 12:24 AM
 */

namespace Game\World;


class Tile
{
    public $sign = ' ';
    public $isPassable = true;

    public $x;
    public $y;

    /**
     * @var \SplObjectStorage
     */
    public $actors;

    public function __construct($x, $y)
    {
        $this->actors = new \SplObjectStorage();
    }

    public function __toString()
    {
        return $this->sign;
    }
}