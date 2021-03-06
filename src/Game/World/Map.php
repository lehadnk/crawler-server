<?php
namespace Game\World;

use Game\Entity\Creature;
use Exception;
use Game\World\MapLoaders\PHPMapLoader;
use Game\World\MapLoaders\TXTMapLoader;
use Helpers;
use Game\Entity\Player;

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
     * @var int[]
     */
    public $size = ['x' => 0, 'y' => 0];

    /**
     * @var Tile[][]
     */
    public $tiles = [];

    /**
     * @var \Game\Entity\Creature[]
     */
    public $creatures = [];

    /**
     * @var Player[]
     */
    public $players = [];

    public $spawnPoint = [1, 1];

    public function load($filename, $verbose = true)
    {
        if (!file_exists($filename)) {
            throw new Exception("No such map exists: $filename");
        }

        if (preg_match('/.*.php/', $filename)) {
            $loader = new PHPMapLoader($this);
            $loader->load($filename);
        } elseif (preg_match('/.*.txt/', $filename)) {
            $loader = new TXTMapLoader($this);
            $loader->load($filename);
        } else {
            throw new Exception("Unknown map format for map $filename");
        }

        if (count($this->tiles) == 0) {
            throw new Exception("Unable to load a map: $filename: it is empty");
        }

        $this->size = [
            'x' => count($this->tiles) - 1,
            'y' => count($this->tiles[0])
        ];

        if ($verbose) {
            echo "Loaded map $filename" . PHP_EOL;
            echo "Map figureprint:" . PHP_EOL;

            Helpers\Coordinates::invertedLoop($this, function(Tile $tile, $isLastOnLine) {
                echo $tile->isPassable ? "\033[0;32m$tile\033[0m" : "\033[0;31m$tile\033[0m";
                if ($isLastOnLine) {
                    echo PHP_EOL;
                }
            });
        }
    }

    public function addCreature(Creature $creature)
    {
        $this->creatures[] = $creature;
        $creature->map = $this;
    }

    public function addPlayer(Player $player)
    {
        $this->addCreature($player);
        $this->players[] = $player;
        list($player->x, $player->y) = $this->spawnPoint;
    }

    public function isTileExists($x, $y)
    {
        return array_key_exists($x, $this->tiles) && array_key_exists($y, $this->tiles[$x]);
    }

    public function isPassable($x, $y)
    {
        return $this->isTileExists($x, $y) && $this->tiles[$x][$y]->isPassable;
    }

    public function notifyPlayers($payload, $excludePlayer = null)
    {
        foreach ($this->players as $player) {
            if ($excludePlayer && $player === $excludePlayer) {
                continue;
            }

            //$player->connection->write($payload);

            $renderer = new Helpers\ASCIIRenderer();
            $data = $renderer->render($this);
            $player->connection->write(strlen($data).' '.$data);
        }
    }

    /**
     * This one exists only because lack of support of nested array typehinting
     * @return Tile
     */
    public function getTile($x, $y) {
        return $this->tiles[$x][$y];
    }
}