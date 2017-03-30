<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 9:43 AM
 */

namespace Helpers;
use Game\World\Map;
use Game\World\Tile;

/**
 * This class contains some helper methods to work with coordinates.
 * @package Helpers
 */
class Coordinates
{
    /**
     * Returns the array of coordinates of a tile $distance away from the $x, $y in the said $direction.
     *
     * @param $x
     * @param $y
     * @param $direction
     * @param int $distance
     * @return array
     */
    public static function vector($x, $y, $direction, $distance = 1) : array {
        switch ($direction) {
            case DIRECTION_UP:
                $y -= $distance;
                break;
            case DIRECTION_DOWN:
                $y += $distance;
                break;
            case DIRECTION_LEFT:
                $x -= $distance;
                break;
            case DIRECTION_RIGHT:
                $x += $distance;
                break;
        }

        return [$x, $y];
    }

    /**
     * Loops through the map in y => x order. This is usable for things like
     * GUIs because in text representation, we expect things to go in the
     * y > x order (line > col).
     *
     * A callback function will be called for every tile on the map, returning
     * the Tile object, and bool with information about if this tile is the last
     * on the line or not.
     *
     * @see Tile
     *
     * @param Map $map
     * @param callable $callback
     */
    public static function invertedLoop(Map $map, callable $callback) {
        for ($y = 0; $y < $map->size['y']; $y++) {
            for ($x = 0; $x < $map->size['x']; $x++) {
                if (!isset($map->tiles[$x][$y])) {
                    die($x.'.'.$y);
                }
                $callback($map->tiles[$x][$y], $x == $map->size['x'] - 1);
            }
        }
    }
}