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
class Hero
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $health = 100;

    /**
     * @var int
     */
    private $attackPoints = 42;

    /**
     * @var int
     */
    private $defence = 0;

    /**
     * @var int
     */
    private $chanceOnMiss;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getHealthPoints()
    {
        return $this->health;
    }

    /**
     * @param int $damage
     */
    public function decreaseHealth($damage)
    {
        if ($damage < $this->health) {
            $this->health = $this->health - $damage;
            return;
        }

        $this->health = 0;
    }

    /**
     * @param int $attackPoints
     */
    public function setAttackPoints($attackPoints)
    {
        $this->attackPoints = $attackPoints;
    }

    /**
     * @return int
     */
    public function getAttackPoints()
    {
        return $this->attackPoints;
    }

    /**
     * @return bool
     */
    public function isDead()
    {
        return $this->health === 0;
    }

    /**
     * @param int $defence
     */
    public function setDefence($defence)
    {
        $this->defence = $defence;
    }

    /**
     * @return int
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * @param int $chanceOnMiss
     */
    public function setChanceOnMiss($chanceOnMiss)
    {
        $this->chanceOnMiss = $chanceOnMiss;
    }

    /**
     * @return int
     */
    public function getChanceOnMiss()
    {
        return $this->chanceOnMiss;
    }
}
