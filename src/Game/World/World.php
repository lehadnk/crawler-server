<?php

namespace Game\World;

use Game\Entity\Player;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 6:29 AM
 */
class World
{
    /**
     * @var Map[]
     */
    public $maps = [];

    /**
     * @var Player[]
     */
    public $players = [];

    /**
     * @var Map
     */
    public $entryLevel;

    public function addMap(Map $map)
    {
        if (empty($this->maps)) {
            $this->entryLevel = $map;
        }

        $this->maps[] = $map;
        $map->world = $this;
    }

    public function loop(\React\EventLoop\Timer\Timer $timer)
    {
        foreach ($this->maps as $map) {
            foreach ($map->creatures as $creature) {
                if ($creature->behaviour !== null) {
                    $creature->behaviour->loop();
                }
            }
        }
    }

    public function addPlayer(Player $player)
    {
        $this->entryLevel->addPlayer($player);
        $this->players[] = $player;
    }

    public function removePlayer(Player $player)
    {
        $player->destroy();
        unset($player);
    }

    public function notifyPlayers($payload, $excludePlayer = null)
    {
        foreach ($this->players as $player) {
            if ($excludePlayer && $player === $excludePlayer) {
                continue;
            }
            $player->connection->write($payload);
        }
    }
}