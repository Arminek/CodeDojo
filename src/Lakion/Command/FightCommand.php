<?php


namespace Lakion\Command;

use Lakion\FightFinishedException;
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
            ->setName('fight')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $firstHero = new Hero('Kamil Kokot');
        $secondHero = new Hero('Zaleś');

        $duel = new Duel($firstHero, $secondHero);

        try {
            while (true) {
                $duel->nextTurn();

                $output->writeln("Turn: " . $duel->getTurn());
                $output->writeln("First hero HP: " . $firstHero->getHealthPoints() . "/100");
                $output->writeln("Second hero HP: " . $secondHero->getHealthPoints() . "/100");

            }
        } catch (FightFinishedException $exception) {
            $output->writeln(sprintf('Hero %s was killed', $exception->getKilledHero()->getName()));
        }
    }
}
