<?php

namespace Lakion;

use Exception;
use Lakion\Model\Hero;

/**
 * @author Mateusz Zalewski <mateusz.p.zalewski@gmail.com>
 * @author Łukasz Chruściel
 * @author Paweł Jędrzejewski
 */
class FightFinishedException extends \RuntimeException
{
    /**
     * @var Hero
     */
    private $killedHero;

    /**
     * {@inheritdoc}
     */
    public function __construct(Hero $killedHero, $message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->killedHero = $killedHero;
    }

    public function getKilledHero()
    {
        return $this->killedHero;
    }
}
