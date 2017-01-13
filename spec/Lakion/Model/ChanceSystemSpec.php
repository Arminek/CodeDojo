<?php

/*
 * This file is part of the Lakion package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Lakion\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
class ChanceSystemSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Model\ChanceSystem');
    }

    function it_randomize_any_chance_in_the_game()
    {
        $this->draw(1)->shouldBeBool();
    }
}
