<?php

use Game\Entity\Creature;

$postCreate = function() {
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
};

$tiles = array_fill(1, 40, array_fill(1, 20, '.'));
$structure = array_fill(1, 40, array_fill(1, 20, ' '));

$this->map->spawnPoint = [5, 5];

return [$tiles, $structure, $postCreate];