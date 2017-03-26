<?php
namespace Game\Entity;
use Interfaces\Vulnerable;

/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 7:24 AM
 */
class Creature extends Base implements Vulnerable
{
    use \Traits\Movable;
    use \Traits\Attacker;
    use \Traits\Vulnerable;

    public $speed = 0.4;
    public $sign = 'c';
    private $hp = 100;

    /**
     * @var \Behaviours\Base
     */
    public $behaviour;

    public function getMovementCooldown()
    {
        return 1 / $this->speed;
    }

    public function destroy()
    {
        foreach ($this->map->creatures as $key => $creature) {
            if ($creature == $this) {
                unset($this->map->creatures[$key]);
            }
        }
    }

    public function getHp()
    {
        return $this->hp;
    }

    public function setHp($value)
    {
        $this->hp = $value;
        if ($this->hp <= 0) {
            $this->die();
        }
    }

    public function die() {
        $this->destroy();
    }
}