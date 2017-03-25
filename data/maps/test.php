<?php

use Game\Entity\Creature;

$creature = new Creature();
$creature->sign = 'C';
$creature->spawn($this->map, 1, 1);
$creature->behaviour = new Behaviours\Wander($creature);

$creature = new Creature();
$creature->sign = 'P';
$creature->speed = '1';
$creature->spawn($this->map, 16, 37);
$creature->behaviour = new \Behaviours\Stand($creature);

$creature = new Creature();
$creature->sign = '@';
$creature->speed = '0.2';
$creature->spawn($this->map, 4, 18);
$creature->behaviour = new \Behaviours\Loaf($creature);

$this->map->spawnPoint = [5, 5];

$tiles = array_fill(1, 20, array_fill(1, 40, '.'));
$structure = array_fill(1, 20, array_fill(1, 40, ' '));

return [$tiles, $structure];