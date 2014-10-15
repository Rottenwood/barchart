<?php
/**
 * Author: Rottenwood
 * Date Created: 15.10.14 9:53
 */

namespace Rottenwood\BarchartBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BarchartCommand extends ContainerAwareCommand {
    protected function configure()
    {
        $this
            ->setName('barchart:parse')
            ->setDescription('Parse price and indicators data from barchart.com')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parser = $this->getContainer()->get("barchart.parser");

        $output->writeln('Parsing data from barchart.com...');
        $output->writeln('Saving futures contracts...');
        $parser->saveAllFutures();
        $output->writeln('Saving forex pairs...');
        $parser->saveAllForex();

        $output->writeln('Parsing done!');
    }
} 