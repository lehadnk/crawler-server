<?php

use Game\Entity\Creature;

$creature = new Creature();
$creature->sign = '@';
$creature->speed = '0.2';
$creature->spawn($this->map, 4, 37);
$creature->behaviour = new \Behaviours\Loaf($creature);

$creature = new Creature();
$creature->sign = '@';
$creature->speed = '0.2';
$creature->spawn($this->map, 17, 37);
$creature->behaviour = new \Behaviours\Loaf($creature);

$creature = new Creature();
$creature->sign = '@';
$creature->speed = '0.2';
$creature->spawn($this->map, 4, 4);
$creature->behaviour = new \Behaviours\Loaf($creature);

$creature = new Creature();
$creature->sign = '@';
$creature->speed = '0.2';
$creature->spawn($this->map, 17, 4);
$creature->behaviour = new \Behaviours\Loaf($creature);

$this->map->spawnPoint = [5, 5];

$map = array_fill(1, 20, array_fill(1, 40, ' '));
foreach ($map as $x => $row) {
    foreach ($row as $y => $cell) {
        if ($x == 1 || $x == 20 || $y == 1 || $y == 40) {
            $map[$x][$y] = '#';
        }
    }
}

$structure = $map;

return [$map, $structure];