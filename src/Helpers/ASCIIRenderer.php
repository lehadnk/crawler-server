<?php

namespace Helpers;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 7:32 AM
 */
class ASCIIRenderer
{
    public function render(\Game\World\Map $map) {
        $picture = $map->tiles;
        foreach ($map->creatures as $creature) {
            $picture[$creature->y][$creature->x] = $creature->sign;
        }

        $string = "";
        foreach ($picture as $row) {
            $string .= implode('', $row).PHP_EOL;
        }

        return $string;
    }
}