<?php

namespace Requests;

use React\Http\Request as HttpRequest;
use React\Http\Response as HttpResponse;
use Helpers\ASCIIRenderer;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 6:36 AM
 */
class SpectatorRequest
{
    /**
     * @var \World
     */
    private $world;

    public function __construct(\World $world)
    {
        $this->world = $world;
    }

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
        }

        $response->end();
    }
}