<?php
/**
 * Author: Rottenwood
 * Date Created: 12.01.15 11:31
 */

namespace Rottenwood\BarchartBundle\Command;

use Rottenwood\BarchartBundle\Entity\Indicator;
use Rottenwood\BarchartBundle\Entity\Price;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixDatabaseCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('barchart:fix:database')->setDescription('Fix prica dates in database');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $repository = $em->getRepository('RottenwoodBarchartBundle:Corn');

        $output->writeln('Обработка котировок ...');

        //        foreach (Indicator::getIndicatorsMethodsAndNames() as $strategyMethod => $indicatorName) {
        //            $indicator = $repository->findByName($indicatorName);
        //
        //            if (!$indicator) {
        //                $indicator = new Indicator();
        //                $indicator->setName($indicatorName);
        //                $indicator->setStrategyMethod($strategyMethod);
        //                $em->persist($indicator);
        //                $output->writeln('Запись индикатора ' . $indicatorName);
        //            }
        //        }
        //
        //        $em->flush();

        //        /** @var Price $price */
        //        foreach ($repository->findPricesBeforeId(742) as $price) {
        //            $output->writeln($price->getDate()->format('d-m-Y H-i-s'));
        //        }

        $prices = $repository->findPricesBeforeId(742);
        /** @var Price $price */
        for ($x = 742; $x == 0; $x--) {
                        $output->writeln($prices[$x]->getData()->format('d-m-Y H-i-s'));
        };


        $output->writeln('Импорт завершен!');
    }
}
