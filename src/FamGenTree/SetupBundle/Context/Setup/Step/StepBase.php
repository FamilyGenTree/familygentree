<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 WorkingDevelopers.NET
 */

namespace FamGenTree\SetupBundle\Context\Setup\Step;

use FamGenTree\SetupBundle\Context\Setup\Config\ConfigAbstract;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class StepBase implements ContainerAwareInterface
{
    use ContainerAwareTrait;
    protected $results = [];
    protected $config  = null;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param \FamGenTree\SetupBundle\Context\Setup\Config\ConfigAbstract $config
     *
     * @return StepResultAggregate|null
     */
    public function checkConfig(ConfigAbstract $config)
    {
        return null;
    }

    abstract public function run();

    public function isSuccess()
    {
        $ret = true;
        foreach ($this->getResults() as $stepResult) {
            $ret = $ret && $stepResult->isSuccess();
        }

        return $ret;
    }

    /**
     * @return StepResult[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return ConfigAbstract|null
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * @param ConfigAbstract|null $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    protected function addResult(StepResult $result)
    {
        $this->results[] = $result;

        return $this;
    }

    protected function createSuccessResultAggregate($name)
    {
        return new StepResultAggregate(
            $name
        );
    }

    /**
     * @return \FamGenTree\SetupBundle\Context\Setup\SetupManager
     */
    protected function getSetupManager()
    {
        return $this->container->get('fgt.setup.manager');
    }
}