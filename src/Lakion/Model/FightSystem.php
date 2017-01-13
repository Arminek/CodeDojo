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
class FightSystem
{
    /**
     * @var ChanceSystem
     */
    private $chanceSystem;

    /**
     * @param ChanceSystem $chanceSystem
     */
    public function __construct(ChanceSystem $chanceSystem)
    {
        $this->chanceSystem = $chanceSystem;
    }

    /**
     * @param Hero $attacker
     * @param Hero $victim
     */
    public function attack(Hero $attacker, Hero $victim)
    {
        $strike = $this->chanceSystem->draw($attacker->getChanceOnMiss(), false);

        if($strike) {
            $victim->decreaseHealth($attacker->getAttackPoints());
        }
    }

    /**
     * @return ChanceSystem
     */
    public function getChanceSystem()
    {
        return $this->chanceSystem;
    }

    /**
     * @param ChanceSystem $chanceSystem
     */
    public function setChanceSystem(ChanceSystem $chanceSystem)
    {
        $this->chanceSystem = $chanceSystem;
    }
}
