<?php

namespace spec\Lakion\Model;

use Lakion\FightFinishedException;
use Lakion\Model\Hero;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin \Lakion\Model\Duel
 */
class DuelSpec extends ObjectBehavior
{
    function let(Hero $firstHero, Hero $secondHero)
    {
        $this->beConstructedWith($firstHero, $secondHero);
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

    function it_goes_to_next_turn(Hero $firstHero, Hero $secondHero)
    {
        $firstHero->getAttackPoints()->willReturn(Argument::any());
        $secondHero->getAttackPoints()->willReturn(Argument::any());

        $firstHero->decreaseHealth(Argument::any())->shouldBeCalled();
        $secondHero->decreaseHealth(Argument::any())->shouldBeCalled();

        $firstHero->getHealthPoints()->shouldBeCalled()->willReturn(Argument::any());
        $secondHero->getHealthPoints()->shouldBeCalled()->willReturn(Argument::any());

        $this->nextTurn();
        $this->getTurn()->shouldReturn(1);
    }

    function it_throws_fight_finished_exception_if_one_dies(Hero $firstHero, Hero $secondHero)
    {
        $firstHero->getAttackPoints()->willReturn(100);
        $secondHero->decreaseHealth(100)->shouldBeCalled();
        $secondHero->getHealthPoints()->willReturn(0);

        $this->shouldThrow(FightFinishedException::class)->duringNextTurn();
    }
    
    function it_indicates_both_die(Hero $firstHero, Hero $secondHero)
    {
        $firstHero->isDead()->willReturn(true);
        $secondHero->isDead()->willReturn(true);

        $this->isFinished()->shouldReturn(true);
    }

    function it_indicates_first_dies(Hero $firstHero, Hero $secondHero)
    {
        $firstHero->isDead()->willReturn(true);
        $secondHero->isDead()->willReturn(false);

        $this->isFinished()->shouldReturn(true);
    }

    function it_indicates_second_dies(Hero $firstHero, Hero $secondHero)
    {
        $firstHero->isDead()->willReturn(false);
        $secondHero->isDead()->willReturn(true);

        $this->isFinished()->shouldReturn(true);
    }

    function it_indicates_both_are_alive(Hero $firstHero, Hero $secondHero)
    {
        $firstHero->isDead()->willReturn(false);
        $secondHero->isDead()->willReturn(false);

        $this->isFinished()->shouldReturn(false);
    }
}
