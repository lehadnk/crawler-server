<?php

namespace Server;
use React\EventLoop\LoopInterface;
use React\Socket\Connection;
use React\Socket\Server;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 11:23 AM
 */
class SocketFactory
{
    public static function createSocket(\Game\World\World $world, LoopInterface $loop) {
        $pool = new ThreadPool();
        $dispatcher = new RequestDispatcher($world, $pool);

        $socket = new Server($loop);
        $socket->on('connection', function(Connection $connection) use ($dispatcher, $pool, $world) {
            $pool->attach($connection);

            $player = new \Game\Entity\Player();
            $player->connection = $connection;
            $world->addPlayer($player);

            $connection->write('6 200 OK');

            $connection->on('data', function($data) use ($connection, $dispatcher, $player) {
                $dispatcher->dispatch($connection, $player, $data);
            });
            $connection->on('end', function() use ($connection, $pool, $world, $player) {
                $player->destroy();
                $pool->detach($connection);
            });
        });

        $loop->addPeriodicTimer(1, function() use ($world, $pool) {
            GarbageCollector::checkTimeout($world, $pool);
        });

        return $socket;
    }
}