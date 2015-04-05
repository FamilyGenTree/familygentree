<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 WorkingDevelopers.NET
 */

namespace FamGenTree\AppBundle\Context\Configuration\Infrastructure;

use FamGenTree\AppBundle\Context\Configuration\Domain\Config\ConfigRepositoryInterface;
use FamGenTree\AppBundle\Context\Configuration\Domain\ConfigKeys;
use FamGenTree\AppBundle\Context\Configuration\Domain\FgtConfig;
use FamGenTree\AppBundle\Entity\Config;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ConfigRepository
    extends ContainerAware
    implements ConfigRepositoryInterface
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return FgtConfig
     */
    public function load()
    {
        $config = new FgtConfig();
        $config->set(
            ConfigKeys::SYSTEM_PATH_ROOT,
            realpath(
                $this->container->get('kernel')
                                ->getRootDir() . '/..'),
            FgtConfig::SCOPE_SITE
        );
        $values = parse_ini_file(__DIR__ . '/../../../Resources/config/config.system.ini');
        foreach ($values as $key => $value) {
            $config->set($key, $value, FgtConfig::SCOPE_SITE);
        }
        $values = parse_ini_file(__DIR__ . '/../../../Resources/config/config.site.ini');
        foreach ($values as $key => $value) {
            $config->set($key, $value, FgtConfig::SCOPE_SITE);
        }
        $this->loadFromNewDb($config, FgtConfig::SCOPE_SITE);
        if (file_exists(__DIR__ . '/../../../Resources/config/config.user.ini')) {
            $values = parse_ini_file(__DIR__ . '/../../../Resources/config/config.user.ini');
            foreach ($values as $key => $value) {
                $config->set($key, $value, FgtConfig::SCOPE_THEME);
            }
        }
        if (file_exists(__DIR__ . '/../../../Resources/config/config.theme.ini')) {
            $values = parse_ini_file(__DIR__ . '/../../../Resources/config/config.theme.ini');
            foreach ($values as $key => $value) {
                $config->set($key, $value, FgtConfig::SCOPE_THEME);
            }
        }

        return $config;
    }

    public function loadSetupConfig()
    {
        $config = new FgtConfig();
        $values = parse_ini_file(__DIR__ . '/../../../Resources/config/config.system.ini');
        foreach ($values as $key => $value) {
            $config->set($key, $value, FgtConfig::SCOPE_SITE);
        }
        $values = parse_ini_file(__DIR__ . '/../../../Resources/config/config.site.ini');
        foreach ($values as $key => $value) {
            $config->set($key, $value, FgtConfig::SCOPE_SITE);
        }
        if (file_exists(__DIR__ . '/../../../Resources/config/config.user.ini')) {
            $values = parse_ini_file(__DIR__ . '/../../../Resources/config/config.user.ini');
            foreach ($values as $key => $value) {
                $config->set($key, $value, FgtConfig::SCOPE_THEME);
            }
        }
        if (file_exists(__DIR__ . '/../../../Resources/config/config.theme.ini')) {
            $values = parse_ini_file(__DIR__ . '/../../../Resources/config/config.theme.ini');
            foreach ($values as $key => $value) {
                $config->set($key, $value, FgtConfig::SCOPE_THEME);
            }
        }

        return $config;
    }

    public function store(FgtConfig $configuration)
    {
    }

    private function loadFromNewDb(FgtConfig $config, $scope)
    {
        $repo = $this->container->get('doctrine')->getRepository('\FamGenTree\AppBundle\Entity\Config');
        $repo->findAll();
        /** @var Config $configObj */
        foreach ($repo->findAll() as $configObj) {
            $config->set($configObj->getSection() . '.' . $configObj->getKey(), $configObj->getValue(), $scope);
        }
    }
}