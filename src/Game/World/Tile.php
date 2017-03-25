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

    public function __toString()
    {
        return $this->sign;
    }
}