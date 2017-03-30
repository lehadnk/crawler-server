<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 11:33 AM
 */

namespace Server;


use React\Socket\Connection;
use SebastianBergmann\CodeCoverage\Report\PHP;

class RequestDispatcher
{
    /**
     * @var \Game\World\World
     */
    private $world;
    /**
     * @var \ThreadPool
     */
    private $pool;

    public function __construct(\Game\World\World $world, ThreadPool $pool)
    {
        $this->world = $world;
        $this->pool = $pool;
    }

    public function dispatch(Connection $connection, \Game\Entity\Player $player, $data) {
        echo '====================================='.PHP_EOL;
        echo $this->pool->getHash($connection).PHP_EOL;
        echo $data.PHP_EOL;

        $chunks = explode(' ', trim($data), 2);
        $opcode = $chunks[0];
        $payload = count($chunks) == 2 ? $chunks[1] : null;

        if (ctype_alnum($opcode)) {
            $class = 'Server\\Controllers\\'.ucfirst($opcode);
            if (class_exists($class)) {
                echo "Calling $class...".PHP_EOL;

                $controller = new $class($this->world, $this->pool, $player);
                $controller->execute($payload);
            }
        }
    }
}