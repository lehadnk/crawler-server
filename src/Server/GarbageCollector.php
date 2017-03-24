<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 25/03/2017
 * Time: 12:01 AM
 */

namespace Server;


class GarbageCollector
{
    public static function checkTimeout(\World $world, ThreadPool $pool) {
        foreach ($world->players as $player) {
            if ($player->lastActivity + PLAYER_CONNECTION_TIMEOUT < time()) {
                $pool->detach($player->connection);
                $player->destroy();
            }
        }
    }
}