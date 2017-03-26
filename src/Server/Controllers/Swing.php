<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 26/03/2017
 * Time: 5:07 AM
 */

namespace Server\Controllers;


class Swing extends Base
{
    public function execute($payload) {
        $this->player->swing();
    }
}