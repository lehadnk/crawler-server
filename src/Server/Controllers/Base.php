<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 5:36 PM
 */

namespace Server\Controllers;

use Server\ThreadPool;

abstract class Base
{
    /**
     * @var \Game\World\World
     */
    protected $world;
    /**
     * @var ThreadPool
     */
    protected $pool;
    /**
     * @var \Game\Entity\Player
     */
    protected $player;

    public function __construct(\Game\World\World $world, ThreadPool $pool, \Game\Entity\Player $player)
    {
        $this->world = $world;
        $this->pool = $pool;
        $this->player = $player;
    }

    protected function notifyMap($payload, $excludeSelf = 1) {
        $excludeSelf = $excludeSelf ? $this->player : null;
        $this->player->map->notifyPlayers($payload, $excludeSelf);
    }

    protected function notifyAll($payload, $excludeSelf = 1) {
        $excludeSelf = $excludeSelf ? $this->player : null;
        $this->player->map->world->notifyPlayers($payload, $excludeSelf);
    }

    abstract public function execute($payload);
}