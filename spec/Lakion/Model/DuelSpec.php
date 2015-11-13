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

use Lakion\Model\FightSystem;
use Lakion\Model\Hero;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
class DuelSpec extends ObjectBehavior
{
    function let(Hero $firstHero, Hero $secondHero, FightSystem $fightSystem)
    {
        $this->beConstructedWith($firstHero, $secondHero, $fightSystem);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Lakion\Model\Duel');
    }

    function it_has_first_hero($firstHero)
    {
        $this->getFirstHero()->shouldReturn($firstHero);
    }

    function it_has_second_hero($secondHero)
    {
        $this->getSecondHero()->shouldReturn($secondHero);
    }

    function it_has_default_turn()
    {
        $this->getTurn()->shouldReturn(0);
    }

    function it_has_current_hero_set_on_first_hero_by_default($firstHero)
    {
        $this->getCurrentHero()->shouldReturn($firstHero);
    }

    function it_goes_to_next_turn()
    {
        $this->endTurn();
        $this->getTurn()->shouldReturn(1);
    }

    function it_switch_current_hero_to_second_hero_if_before_was_first_hero($firstHero, $secondHero)
    {
        $this->setCurrentHero($firstHero);
        $this->endTurn();
        $this->getCurrentHero()->shouldReturn($secondHero);
    }

    function it_switch_current_hero_to_first_hero_if_before_was_second_hero($firstHero, $secondHero)
    {
        $this->setCurrentHero($secondHero);
        $this->endTurn();
        $this->getCurrentHero()->shouldReturn($firstHero);
    }

    function it_has_fight_system(FightSystem $fightSystem)
    {
        $this->setFightSystem($fightSystem);
        $this->getFightSystem()->shouldReturn($fightSystem);
    }

    function it_process_turn_first_hero_should_attack_his_victim($firstHero, $secondHero, $fightSystem)
    {
        $this->setCurrentHero($firstHero);
        $fightSystem->attack($firstHero, $secondHero)->shouldBeCalled();
        $this->processTurn();
    }

    function it_process_turn_second_hero_should_attack_his_victim($firstHero, $secondHero, $fightSystem)
    {
        $this->setCurrentHero($secondHero);
        $fightSystem->attack($secondHero, $firstHero)->shouldBeCalled();
        $this->processTurn();
    }

    function it_returns_true_if_any_hero_died($firstHero, $secondHero)
    {
        $firstHero->getHealthPoints()->willReturn(10);
        $secondHero->getHealthPoints()->willReturn(0);

        $this->isAnyoneDead()->shouldReturn(true);
    }
}
