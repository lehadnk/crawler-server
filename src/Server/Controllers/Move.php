<?php
/**
 * Created by PhpStorm.
 * User: lehadnk
 * Date: 24/03/2017
 * Time: 5:35 PM
 */

namespace Server\Controllers;


class Move extends Base
{
    public function execute($payload) {
        if (in_array($payload, [
            DIRECTION_UP,
            DIRECTION_DOWN,
            DIRECTION_LEFT,
            DIRECTION_RIGHT
        ])) {
            $this->player->step($payload);
        }
    }
}