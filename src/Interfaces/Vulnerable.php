<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 26/03/2017
 * Time: 4:52 AM
 */

namespace Interfaces;

/**
 * Interface Vulnerable
 *
 * An object implementing this interface could take damage from the different sources (combat, environment, e.t.c).
 *
 * @package Interfaces
 */
interface Vulnerable
{
    /**
     * Makes the actor to take $damage amount of damage.
     *
     * @param $amount
     * @return mixed
     */
    public function recieveDamage($amount);
}