<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 6:27 AM
 */

require 'vendor/autoload.php';
require 'src/constants.php';

$loop = React\EventLoop\Factory::create();

/**
 * Initializing game world
 */
$world = Loader::createWorld(__DIR__.'/data/');
$loop->addPeriodicTimer(Helpers\Timer::$loopInterval, [$world, 'loop']);

/**
 * Binary player server
 */
$socket = new React\Socket\Server($loop);
$socket = \Server\SocketFactory::createSocket($world, $loop);
$socket->listen(1488);
echo "Server running at http://127.0.0.1:1488\n";

/**
 * Http player server
 */
$socket = new React\Socket\Server($loop);
$socket =

/**
 * Spectator server
 */
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);

$request = new \Requests\SpectatorRequest($world);
$http->on('request', [$request, 'handle']);

$socket->listen(1337);
echo "Spectator running at http://127.0.0.1:1337\n";

/**
 * Starting EventLoop
 */
$loop->run();