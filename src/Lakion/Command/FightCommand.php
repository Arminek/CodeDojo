<?php

/*
 * This file is part of the Lakion package.
 *
 * (c) Lakion
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lakion\Command;

use Lakion\Model\ChanceSystem;
use Lakion\Model\FightSystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Lakion\Model\Hero;
use Lakion\Model\Duel;

/**
 * @author Mateusz Zalewski <mateusz.p.zalewski@gmail.com>
 */
class FightCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('start')
            ->setDescription('It starts the game')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $firstHero = new Hero('Kamil Kokot');
        $secondHero = new Hero('Zaleś');
        $firstHero->setChanceOnMiss(10);
        $secondHero->setChanceOnMiss(10);
        $firstHero->setAttackPoints(10);
        $secondHero->setAttackPoints(15);
        $chanceSystem = new ChanceSystem();
        $fightSystem = new FightSystem($chanceSystem);

        $duel = new Duel($firstHero, $secondHero, $fightSystem);

        do {
            sleep(1);
            $output->writeln("Turn: " . $duel->getTurn());
            $output->writeln("First hero HP: " . $firstHero->getHealthPoints() . "/100");
            $output->writeln("Second hero HP: " . $secondHero->getHealthPoints() . "/100");
            $duel->processTurn();
            $duel->endTurn();


        } while(!$duel->isAnyoneDead());

        $output->writeln("Turn: " . $duel->getTurn());
        $output->writeln("First hero HP: " . $firstHero->getHealthPoints() . "/100");
        $output->writeln("Second hero HP: " . $secondHero->getHealthPoints() . "/100");
        if($firstHero->isDead()) {
            $output->writeln("Winner is: ". $secondHero->getName());

            return;
        }

        $output->writeln("Winner is: ". $firstHero->getName());
    }
}
