<?php
/**
 * Author: Rottenwood
 * Date Created: 23.12.14 10:49
 */

namespace Rottenwood\BarchartBundle\Command;

use Rottenwood\BarchartBundle\Entity\Indicator;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportIndicatorsCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('barchart:import:indicators')->setDescription('Import indicators dictionary to database');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $repository = $em->getRepository('RottenwoodBarchartBundle:Indicator');

        $output->writeln('Импорт индикаторов ...');

        foreach (Indicator::getIndicatorsMethodsAndNames() as $strategyMethod => $indicatorName) {
            $indicator = $repository->findByName($indicatorName);

            if (!$indicator) {
                $indicator = new Indicator();
                $indicator->setName($indicatorName);
                $indicator->setStrategyMethod($strategyMethod);
                $em->persist($indicator);
                $output->writeln('Запись индикатора ' . $indicatorName);
            }
        }

        $em->flush();

        $output->writeln('Импорт завершен!');
    }
}
