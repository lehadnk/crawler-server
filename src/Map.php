<?php

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 7:09 AM
 */
class Map
{
    /**
     * @var World
     */
    public $world;

    /**
     * @var array
     */
    public $tiles = [];

    /**
     * @var Creature[]
     */
    public $creatures = [];

    /**
     * @var Player[]
     */
    public $players = [];

    public $spawnPoint = [1, 1];

    public function load($filename) {
        if (!file_exists($filename)) {
            throw new Exception("No such map exists: $filename");
        }

        $this->tiles = include $filename;

        echo "Loaded map $filename".PHP_EOL;
        echo "Map figureprint:".PHP_EOL;
        foreach ($this->tiles as $row) {
            foreach ($row as $cell) {
                echo $cell;
            }
            echo PHP_EOL;
        }
    }

    public function addCreature(Creature $creature) {
        $this->creatures[] = $creature;
        $creature->map = $this;
    }

    public function addPlayer(Player $player) {
        $this->addCreature($player);
        $this->players[] = $player;
        list($player->x, $player->y) = $this->spawnPoint;
    }

    public function isCellExists($x, $y) {
        return array_key_exists($x, $this->tiles) && array_key_exists($y, $this->tiles[$x]);
    }

    public function isPassable($x, $y) {
        return $this->isCellExists($x, $y);
    }

    public function notifyPlayers($payload, $excludePlayer = null) {
        foreach ($this->players as $player) {
            if ($excludePlayer && $player === $excludePlayer) {
                continue;
            }
            $player->connection->write($payload);
        }
    }
}