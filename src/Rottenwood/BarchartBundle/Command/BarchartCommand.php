<?php
/**
 * Author: Rottenwood
 * Date Created: 15.10.14 9:53
 */

namespace Rottenwood\BarchartBundle\Command;

use Rottenwood\BarchartBundle\Entity\Price;
use Rottenwood\BarchartBundle\Service\BarchartParserService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BarchartCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('barchart:parse')->setDescription('Parse price and indicators data from barchart.com');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $parser = $this->getContainer()->get('barchart.parser');

        $output->writeln('Parsing data from barchart.com...');

        $output->writeln('Saving futures contracts...');
        foreach ($parser->parseActualFutures() as $symbolName => $symbol) {
            $this->savePriceWithOutput($output, $parser, $symbol, $symbolName, Price::CONTRACT_TYPE_FUTURES);
        }

        $output->writeln('Saving forex pairs...');
        foreach ($this->getContainer()->get('barchart.config')->getConfig()['url']['forex'] as $currency => $currencyUrl) {
            $this->savePriceWithOutput($output, $parser, $currency, $currency, Price::CONTRACT_TYPE_FOREX);
        }

        $output->writeln('Parsing done!');
    }

    private function savePriceWithOutput(OutputInterface $output, BarchartParserService $parser, $symbol, $symbolName, $type) {
        $output->write('Saving ' . $symbol . '...');
        $parser->savePrice($symbolName, $symbol, $type);
        $output->writeln(' saved!');
    }
}
