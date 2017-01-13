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
class HeroSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith('Krzysio Krawczyk');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Model\Hero');
    }

    function it_has_name()
    {
        $this->getName()->shouldReturn('Krzysio Krawczyk');
    }

    function it_has_100_default_health_points()
    {
        $this->getHealthPoints()->shouldReturn(100);
    }

    function its_health_level_can_be_lowered()
    {
        $this->decreaseHealth(10);
        $this->getHealthPoints()->shouldReturn(90);
    }

    function it_has_attack_points()
    {
        $this->setAttackPoints(50);
        $this->getAttackPoints()->shouldReturn(50);
    }

    function its_health_can_not_be_less_than_zero()
    {
        $this->decreaseHealth(110);
        $this->getHealthPoints()->shouldReturn(0);
    }

    function it_returns_the_hero_is_not_dead_by_default()
    {
        $this->isDead()->shouldReturn(false);
    }

    function it_returns_if_the_hero_is_dead()
    {
        $this->decreaseHealth(101);
        $this->isDead()->shouldReturn(true);
    }

    function it_has_defence()
    {
        $this->setDefence(10);
        $this->getDefence()->shouldReturn(10);
    }

    function it_has_chance_on_miss()
    {
        $this->setChanceOnMiss(8);
        $this->getChanceOnMiss()->shouldReturn(8);
    }
}
