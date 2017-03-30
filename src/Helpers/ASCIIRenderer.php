<?php

namespace Helpers;

/**
 * Renders the ASCII version of the game field. Not intended to be used on
 * production - just for testing purposes only.
 *
 * User: lehadnk
 * Date: 24/03/2017
 */
class ASCIIRenderer
{
    /**
     * Returns a string image of the map with all creatures on it.
     * @param \Game\World\Map $map
     * @return string
     */
    public function render(\Game\World\Map $map) : string {
        $picture = $map->tiles;

        foreach ($map->creatures as $creature) {
            $picture[$creature->x][$creature->y] = $creature->sign;
        }

        $string = "";
        for ($y = 0; $y < $map->size['y']; $y++) {
            for ($x = 0; $x < $map->size['x']; $x++) {
                $string .= $picture[$x][$y];
            }
            $string .= PHP_EOL;
        }

        return $string;
    }
}