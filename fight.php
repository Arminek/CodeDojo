<?php

include 'vendor/autoload.php';

use Lakion\Command\FightCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new FightCommand());
$application->run();
