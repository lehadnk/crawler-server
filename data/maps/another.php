<?php

use Game\Entity\Creature;

$postCreate = function()
{
    $creature = new Creature();
    $creature->sign = '@';
    $creature->speed = '0.2';
    $creature->spawn($this->map, 36, 1);
    $creature->behaviour = new \Behaviours\Loaf($creature);

    $creature = new Creature();
    $creature->sign = '@';
    $creature->speed = '0.2';
    $creature->spawn($this->map, 36, 17);
    $creature->behaviour = new \Behaviours\Loaf($creature);

    $creature = new Creature();
    $creature->sign = '@';
    $creature->speed = '0.2';
    $creature->spawn($this->map, 1, 1);
    $creature->behaviour = new \Behaviours\Loaf($creature);

    $creature = new Creature();
    $creature->sign = '@';
    $creature->speed = '0.2';
    $creature->spawn($this->map, 1, 17);
    $creature->behaviour = new \Behaviours\Loaf($creature);
};

$map = array_fill(0, 19, array_fill(0, 39, ' '));
foreach ($map as $y => $row) {
    foreach ($row as $x => $cell) {
        if ($y == 0 || $y == 18 || $x == 0 || $x == 37) {
            $map[$y][$x] = '#';
        }
    }
}

$structure = $map;

$this->map->spawnPoint = [5, 5];

return [$map, $structure, $postCreate];