<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 26/03/2017
 * Time: 4:32 AM
 */

namespace Traits;


trait Vulnerable
{
    abstract function getHp();
    abstract function setHp($value);

    public function recieveDamage($amount) {
        $this->setHp($this->getHp() - $amount);
    }
}