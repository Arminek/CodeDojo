<?php

/*
 * This file is part of the Lakion package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lakion\Model;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
class ChanceSystem
{
    /**
     * @param $attribute
     * @param bool|true $positive
     *
     * @return bool
     */
    public function draw($attribute, $positive = true)
    {
        if($positive) {
            return mt_rand(1, 100) <= $attribute;
        }

        return mt_rand(1, 100) <= 100-$attribute;
    }
}
