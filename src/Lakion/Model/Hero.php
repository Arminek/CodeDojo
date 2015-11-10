<?php

namespace Lakion\Model;

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
}
