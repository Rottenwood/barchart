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
        $this->setName('barchart:fix:database')->setDescription('Fix price dates in database');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $output->writeln('Обработка котировок ...');

        $repositories = [
            $em->getRepository('RottenwoodBarchartBundle:CrudeOil'),
            $em->getRepository('RottenwoodBarchartBundle:Corn'),
            $em->getRepository('RottenwoodBarchartBundle:DJMini'),
        ];

        //        $repository = $em->getRepository('RottenwoodBarchartBundle:CrudeOil');
        //        $id = 909;

        //        $repository = $em->getRepository('RottenwoodBarchartBundle:CrudeOil');
        //        $id = 909;

        foreach ($repositories as $repository) {
            $prices = $repository->findPricesBeforeId(1500);

            $validPrice = end($prices);

            $date = $validPrice->getDate();

            var_dump($date->format('d-m-Y H:i') . ':00');die;

            /** @var Price[] $prices */
            for ($x = count($prices) - 1; $x >= 0; $x--) {
                $output->writeln($prices[$x]->getDate()->format('d-m-Y H:i') . ':00');
                die;

                $date->modify('-1 hour');
                $prices[$x]->setDate($date);
                $em->flush();
            };

        }

        $output->writeln('Реконструкция дат котировок завершена!');
    }
}
