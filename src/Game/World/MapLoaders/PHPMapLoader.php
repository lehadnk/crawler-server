<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 26/03/2017
 * Time: 12:28 AM
 */

namespace Game\World\MapLoaders;


use Game\World\Map;
use Game\World\Tile;

class PHPMapLoader
{
    private $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function load($filename) {
        list($tiles, $structure, $postCreate) = include $filename;

        $map = [];
        foreach ($tiles as $x => $row) {
            foreach ($row as $y => $cell) {
                $tile = new Tile();
                $tile->sign = $cell;
                $tile->isPassable = $structure[$x][$y] == ' ' ? true : false;

                $map[$x][$y] = $tile;
            }
        }

        $this->map->tiles = $map;

        if (is_callable($postCreate)) {
            $postCreate();
        }
    }
}