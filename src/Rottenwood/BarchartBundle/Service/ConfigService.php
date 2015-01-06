<?php
/**
 * Author: Rottenwood
 * Date Created: 13.09.14 3:13
 */

namespace Rottenwood\BarchartBundle\Service;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Yaml\Yaml;

/**
 * Сервис импорта и хранения конфига.
 * @package Rottenwood\BarchartBundle\Service
 */
class ConfigService {
    protected $kernel;
    protected $config;

    public function __construct(KernelInterface $kernel) {
        $this->kernel = $kernel;
        $this->config = $this->configLoad();
    }

    /**
     * Загрузка файла конфигурации (barchart.yml)
     * @throws \Symfony\Component\Security\Acl\Exception\Exception
     * @return array
     */
    protected function configLoad() {
        $path = $this->kernel->locateResource("@RottenwoodBarchartBundle/Resources/config/barchart.yml");
        if (!is_string($path)) {
            throw new Exception("$path должен быть строкой.");
        }
        $config = Yaml::parse(file_get_contents($path));

        return $config;
    }

    /**
     * Геттер для config
     * @return array
     */
    public function getConfig() {

        return $this->config;
    }

}
