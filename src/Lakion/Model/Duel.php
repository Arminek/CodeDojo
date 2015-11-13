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
class Duel
{
    /**
     * @var FightSystem
     */
    private $fightSystem;

    /**
     * @var Hero
     */
    private $firstHero;

    /**
     * @var Hero
     */
    private $secondHero;

    /**
     * @var Hero
     */
    private $currentHero;

    /**
     * @var int
     */
    private $turn = 0;

    /**
     * @param Hero $firstHero
     * @param Hero $secondHero
     * @param FightSystem $fightSystem
     */
    public function __construct(Hero $firstHero, Hero $secondHero, FightSystem $fightSystem)
    {
        $this->fightSystem = $fightSystem;
        $this->currentHero = $firstHero;
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
     * @return Hero
     */
    public function getCurrentHero()
    {
        return $this->currentHero;
    }

    /**
     * @param $hero
     */
    public function setCurrentHero($hero)
    {
        $this->currentHero = $hero;
    }

    /**
     * @param FightSystem $fightSystem
     */
    public function setFightSystem(FightSystem $fightSystem)
    {
        $this->fightSystem = $fightSystem;
    }

    /**
     * @return FightSystem
     */
    public function getFightSystem()
    {
        return $this->fightSystem;
    }

    /**
     * @return int
     */
    public function getTurn()
    {
        return $this->turn;
    }

    public function processTurn()
    {
        if ($this->firstHero === $this->currentHero) {
            $this->fightSystem->attack($this->currentHero, $this->secondHero);

            return;
        }

        $this->fightSystem->attack($this->currentHero, $this->firstHero);
    }

    public function endTurn()
    {
        $this->switchHero();

        $this->nextTurn();
    }

    /**
     * @return bool
     */
    public function isAnyoneDead()
    {
        return 0 === $this->firstHero->getHealthPoints() || 0 === $this->secondHero->getHealthPoints();
    }

    private function switchHero()
    {
        if ($this->firstHero === $this->currentHero) {
            $this->currentHero = $this->secondHero;

            return;
        }

        $this->currentHero = $this->firstHero;
    }

    private function nextTurn()
    {
        $this->turn++;
    }
}
