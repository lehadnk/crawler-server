<?php

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 11:58 AM
 */
class Player extends Creature
{

    public $speed = 2;

    /**
     * @var \React\Socket\Connection
     */
    public $connection;

    public function destroy() {
        parent::destroy();

        foreach ($this->map->players as $key => $player) {
            if ($player === $this) {
                unset($this->map->players[$key]);
            }
        }

        foreach ($this->map->world->players as $key => $player) {
            if ($player === $this) {
                unset($this->map->world->players[$key]);
            }
        }

    }
}