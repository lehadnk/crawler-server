<?php

namespace Behaviours;
use Helpers\Coordinates;
use Helpers\Distance;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 9:20 AM
 */
class Loaf extends Base
{
    private $spawnX, $spawnY;

    public $radius = 3;

    public function __construct(\Game\Entity\Creature $actor, $options = [])
    {
        parent::__construct($actor);
        $this->spawnX = $actor->x;
        $this->spawnY = $actor->y;
    }

    public function loop() {
        $direction = rand(0, 3);
        $direction = [DIRECTION_UP, DIRECTION_RIGHT, DIRECTION_LEFT, DIRECTION_RIGHT][$direction];
        list($newX, $newY) = Coordinates::vector($this->actor->getX(), $this->actor->getY(), $direction);

        if (Distance::to(
            $this->spawnX,
            $this->spawnY,
            $newX,
            $newY
        ) <= $this->radius) {
            $this->actor->step($direction);
        }
    }
}