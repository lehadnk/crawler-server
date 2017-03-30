<?php

namespace Requests;

use React\Http\Request as HttpRequest;
use React\Http\Response as HttpResponse;
use Helpers\ASCIIRenderer;

/**
 * This request is allowing the user to connect using an HTTP client to
 * get some general information about the game world: ASCII picture of the
 * game world, creatures status, and some other useful debug information.
 *
 * User: lehadnk
 * Date: 24/03/2017
 */
class SpectatorRequest
{
    /**
     * @var \Game\World\World
     */
    private $world;

    /**
     * SpectatorRequest constructor.
     * @param \Game\World\World $world The world we're going to observe
     */
    public function __construct(\Game\World\World $world)
    {
        $this->world = $world;
    }

    /**
     * The http request handler.
     *
     * @param HttpRequest $request
     * @param HttpResponse $response
     */
    public function handle(HttpRequest $request, HttpResponse $response) {
        $response->writeHead(200, array('Content-Type' => 'text/plain'));

        $memory = memory_get_usage() / 1024;
        $formatted = number_format($memory, 0).'K';
        $response->write("Current memory usage: {$formatted}\n");
        $playersCount = count($this->world->players);
        $response->write("Active players: {$playersCount}\n");

        $response->write(PHP_EOL.PHP_EOL);

        $renderer = new ASCIIRenderer();
        foreach ($this->world->maps as $id => $map) {
            $response->write("Map #$id".PHP_EOL);
            $response->write("Active players: ".count($map->players).PHP_EOL);
            $response->write($renderer->render($map).PHP_EOL);

            $response->write('Creatures:'.PHP_EOL);
            foreach ($map->creatures as $creature) {
                $info = $creature->getId().' HP:'.$creature->getHp();
                $response->write($info.PHP_EOL);
            }
            $response->write(PHP_EOL.PHP_EOL);
        }

        $response->end();
    }
}