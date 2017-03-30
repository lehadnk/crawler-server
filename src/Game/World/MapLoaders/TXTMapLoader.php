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

class TXTMapLoader
{
    private $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function load($filename) {
        $file = $file = fopen($filename, "r");

        if (!$file) {
            throw new Exception("Error opening the map file.");
        }

        $map = [];

        $y = 0;
        while(!feof($file)) {
            $line = fgets($file);
            for( $x = 0; $x < strlen($line); $x++) {
                $char = substr( $line, $x, 1 );
                $tile = new Tile($x, $y);
                $tile->sign = $char;
                $tile->isPassable = true;

                $map[$x][$y] = $tile;
            }
            $y++;
        }
        fclose($file);

        $this->map->tiles = $map;
    }
}