<?php
/**
 * Author: Rottenwood
 * Date Created: 12.01.15 11:31
 */

namespace Rottenwood\BarchartBundle\Command;

use Doctrine\Common\Collections\Criteria;
use Rottenwood\BarchartBundle\Entity\Price;
use Rottenwood\BarchartBundle\Entity\Symbol;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Команда восстановления корректных дат всех котировок (до определенного ID) в базе данных
 * @package Rottenwood\BarchartBundle\Command
 */
class FixDatabaseCommand extends ContainerAwareCommand {

    const VALID_PRICE_ID = 1500;

    protected function configure() {
        $this->setName('barchart:fix:database')->setDescription('Fix price dates in database');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $progress = $this->getHelper('progress');

        $output->writeln('Обработка котировок ...');

        foreach (Symbol::getSymbolName() as $repositoryName) {
            $repositoryNamespace = 'RottenwoodBarchartBundle:' . $repositoryName;
            $repository = $em->getRepository($repositoryNamespace);
            $output->writeln('Обработка репозитория ' . $repositoryName . ' ...');
            $prices = $repository->findPricesBeforeId(self::VALID_PRICE_ID);
            /** @var Price[] $prices */
            $date = $prices[0]->getDate();
            $prices = $repository->findPricesBeforeId(self::VALID_PRICE_ID, Criteria::ASC);

            $pricesCount = count($prices);
            $progress->start($output, $pricesCount);
            for ($x = $pricesCount - 1; $x >= 0; $x--) {
                $prices[$x]->setDate($date);
                $em->flush();
                $date->modify('-1 hour');
                $progress->advance();
                $output->writeln('');
            };
        }

        $output->writeln('Реконструкция дат всех котировок завершена!');
    }
}
