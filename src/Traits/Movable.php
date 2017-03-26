<?php

namespace Traits;
use Helpers\Distance;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 7:48 AM
 */
trait Movable
{
    private $timeLastMove;

    /**
     * @return \Game\World\Map
     */
    abstract function getMap();
    abstract function getX();
    abstract function getY();
    abstract function setX($x);
    abstract function setY($y);
    abstract function getDirection();
    abstract function setDirection($direction);
    abstract function getMovementCooldown();
    abstract function getId();

    public function step($direction) {
        $this->turn($direction);
        if ($this->couldStep($direction)) {
            $newX = $this->getX();
            $newY = $this->getY();

            switch ($direction) {
                case DIRECTION_UP:
                    $newY -= 1;
                    break;
                case DIRECTION_DOWN:
                    $newY += 1;
                    break;
                case DIRECTION_LEFT:
                    $newX -= 1;
                    break;
                case DIRECTION_RIGHT:
                    $newX += 1;
                    break;
            }

            $this->position($newX, $newY);
            return true;
        }

        return false;
    }

    public function turn($direction) {
        $this->setDirection($direction);
    }

    public function move($newX, $newY) {
        if ($this->couldMove($newX, $newY)) {
            $this->position($newX, $newY);
            return true;
        }

        return false;
    }

    public function teleport($newX, $newY) {
        if ($this->couldTeleport($newX, $newY)) {
            $this->position($newX, $newY);
            return true;
        }
        return false;
    }

    private function position($newX, $newY) {
        $this->getMap()->getTile($this->getX(), $this->getY())->actors->detach($this);
        $this->getMap()->getTile($newX, $newY)->actors->attach($this);
        $this->setX($newX);
        $this->setY($newY);
        $this->timeLastMove = microtime(true);
        $this->getMap()->notifyPlayers(OPCODE_MOVE.' '.$this->getId().' '.$newX.' '.$newY);
    }

    private function isMoveOffCooldown() {
        return !($this->timeLastMove + $this->getMovementCooldown() > microtime(true));
    }

    public function couldStep($direction) {
        if (!$this->isMoveOffCooldown()) {
            return false;
        }

        $newX = $this->getX();
        $newY = $this->getY();

        switch ($direction) {
            case DIRECTION_UP:
                $newY -= 1;
                break;
            case DIRECTION_DOWN:
                $newY += 1;
                break;
            case DIRECTION_LEFT:
                $newX -= 1;
                break;
            case DIRECTION_RIGHT:
                $newX += 1;
                break;
        }

        return $this->getMap()->isPassable($newX, $newY);
    }

    public function couldTeleport($newX, $newY) {
        return $this->getMap()->isPassable($newX, $newY);
    }

    public function couldMove($newX, $newY) {
        return
                $this->isMoveOffCooldown()
            &&
                $this->getMap()->isPassable($newX, $newY)
            &&
                Distance::to(
                    $this->getX(),
                    $this->getY(),
                    $newX,
                    $newY
                ) == 1;
    }
}