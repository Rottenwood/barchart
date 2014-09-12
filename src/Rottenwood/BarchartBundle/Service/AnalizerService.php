<?php
/**
 * Author: Rottenwood
 * Date Created: 13.09.14 2:58
 */

namespace Rottenwood\BarchartBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Сервис анализа данных технических индикаторов
 * @package Rottenwood\BarchartBundle\Service
 */
class AnalizerService {
    private $em;
    private $kernel;

    public function __construct(ConfigService $configService, EntityManager $em, Kernel $kernel) {
        $this->em = $em;
        $this->kernel = $kernel;
    }
}