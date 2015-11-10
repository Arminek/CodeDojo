<?php

namespace Lakion\Model;

use Lakion\FightFinishedException;

class Duel
{
    const CHANCE_THRESHOLD = 5;

    /**
     * @var Hero
     */
    private $firstHero;

    /**
     * @var Hero
     */
    private $secondHero;

    /**
     * @var int
     */
    private $turn = 0;

    /**
     * @param Hero $firstHero
     * @param Hero $secondHero
     */
    public function __construct(Hero $firstHero, Hero $secondHero)
    {
        $this->firstHero = $firstHero;
        $this->secondHero = $secondHero;
    }

    /**
     * @return Hero
     */
    public function getFirstHero()
    {
        return $this->firstHero;
    }

    /**
     * @return Hero
     */
    public function getSecondHero()
    {
        return $this->secondHero;
    }

    /**
     * @return int
     */
    public function getTurn()
    {
        return $this->turn;
    }

    public function nextTurn()
    {
        $chance = mt_rand(0, 1);

        $attacker = $this->secondHero;
        $defender = $this->firstHero;

        if (0 === $chance) {
            $attacker = $this->firstHero;
            $defender = $this->secondHero;
        }

        $this->attack($attacker, $defender);
        $this->turn++;
    }

    /**
     * @return bool
     */
    public function isFinished()
    {
        return $this->firstHero->isDead() || $this->secondHero->isDead();
    }

    /**
     * @param Hero $attacker
     * @param Hero $victim
     *
     * @throws FightFinishedException
     */
    private function attack(Hero $attacker, Hero $victim)
    {
        $victim->decreaseHealth($attacker->getAttackPoints());
        if (0 === $victim->getHealthPoints()) {
            throw new FightFinishedException($victim);
        }
    }
}
