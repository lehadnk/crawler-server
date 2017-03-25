<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 9:23 AM
 */

namespace Behaviours;


abstract class Base
{
    /**
     * @var \Game\Entity\Creature
     */
    protected $actor;

    public function __construct(\Game\Entity\Creature $actor, $options = [])
    {
        $this->actor = $actor;
        foreach ($options as $field => $value) {
            $this->{$field} = $value;
        }
    }

    abstract public function loop();
}