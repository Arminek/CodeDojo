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

use Lakion\Model\ChanceSystem;
use Lakion\Model\Hero;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
class FightSystemSpec extends ObjectBehavior
{
    function let(ChanceSystem $chanceSystem)
    {
        $this->beConstructedWith($chanceSystem);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Model\FightSystem');
    }

    function it_decrease_health_on_victim_if_attacker_does_not_miss(
        Hero $firstHero,
        Hero $secondHero,
        ChanceSystem $chanceSystem
    ) {
        $firstHero->getChanceOnMiss()->willReturn(8);
        $firstHero->getAttackPoints()->willReturn(20);

        $chanceSystem->draw(8, false)->willReturn(true);

        $secondHero->decreaseHealth(20)->shouldBeCalled();
        $firstHero->decreaseHealth(Argument::any())->shouldNotBeCalled();

        $this->attack($firstHero, $secondHero);
    }

    function it_does_not_decrease_health_on_victim_if_attacker_missed(
        Hero $firstHero,
        Hero $secondHero,
        ChanceSystem $chanceSystem
    ) {
        $firstHero->getChanceOnMiss()->willReturn(8);
        $firstHero->getAttackPoints()->willReturn(20);

        $chanceSystem->draw(8, false)->willReturn(false);

        $secondHero->decreaseHealth(20)->shouldNotBeCalled();
        $firstHero->decreaseHealth(Argument::any())->shouldNotBeCalled();

        $this->attack($firstHero, $secondHero);
    }

    function it_has_chance_system_by_default($chanceSystem)
    {
        $this->getChanceSystem()->shouldReturn($chanceSystem);
    }

    function it_has_chance_system(ChanceSystem $chanceSystem)
    {
        $this->setChanceSystem($chanceSystem);
        $this->getChanceSystem()->shouldReturn($chanceSystem);
    }
}
