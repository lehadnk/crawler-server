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
    public function render(\Map $map) {
        $picture = $map->tiles;
        foreach ($map->creatures as $creature) {
            $picture[$creature->x][$creature->y] = $creature->sign;
        }

        $string = "";
        foreach ($picture as $row) {
            $string .= implode('', $row).PHP_EOL;
        }

        return $string;
    }
}