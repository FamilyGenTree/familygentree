<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 WorkingDevelopers.NET
 */

namespace FamGenTree\AppBundle\Context\Configuration\Domain;

class FgtConfig implements ConfigKeys
{
    const LAYER_SYSTEM  = 0;
    const LAYER_SITE    = 1;
    const LAYER_USER    = 2;
    const LAYER_TREE    = 3;
    const LAYER_THEME   = 5;
    const LAYER_RUNTIME = 10;

    protected static $LAYER_ORDER = array(
        self::LAYER_RUNTIME,
        self::LAYER_TREE,
        self::LAYER_USER,
        self::LAYER_THEME,
        self::LAYER_SITE,
        self::LAYER_SYSTEM
    );

    /**
     * @var ConfigLayerSystem
     */
    protected $configLayerSystem = null;
    /**
     * @var ConfigLayerSite
     */
    protected $configLayerSite = null;
    /**
     * @var ConfigLayerUser
     */
    protected $configLayerUser;
    /**
     * @var ConfigLayerTree
     */
    protected $configLayerTree;
    /**
     * @var ConfigLayerRuntime
     */
    protected $configLayerRuntime;
    /**
     * @var ConfigLayerTheme
     */
    protected $configLayerTheme;

    function __construct()
    {
        $this->configLayerSystem  = new ConfigLayerSystem();
        $this->configLayerSite    = new ConfigLayerSite();
        $this->configLayerUser    = new ConfigLayerUser();
        $this->configLayerTree    = new ConfigLayerTree();
        $this->configLayerRuntime = new ConfigLayerRuntime();
        $this->configLayerTheme   = new ConfigLayerTheme();
    }

    /**
     * @param      $key
     * @param      $value
     * @param      $layer
     * @param bool $immutable
     *
     * @return $this Fluent interface
     * @throws \FamGenTree\AppBundle\Context\Configuration\Domain\Exception\ImmutableValue
     */
    public function set($key, $value, $layer, $immutable = false)
    {
        $this->validateLayer($layer);
        $section = $this->getLayer($layer);
        $section->setValue($key, $value, $immutable);

        return $this;
    }

    /**
     * @param     $key
     * @param int $layer
     *
     * @return ConfigValue|null
     */
    public function get($key, $layer = null)
    {
        $this->validateLayer($layer);

        if (null === $layer) {
            foreach (static::$LAYER_ORDER as $nextScope) {
                $section = $this->getLayer($nextScope);
                if ($section->isDefined($key)) {
                    return $section->getValue($key);
                }
            }
        } else {
            $section = $this->getLayer($layer);

            return $section->getValue($key);
        }
    }

    public function getValue($key, $layer = null, $default = null)
    {
        $ret = $this->get($key, $layer);

        return $ret != null ? $ret->getValue() : $default;
    }

    public function getConfigTheme($key)
    {
        return $this->getLayer(static::LAYER_THEME)->getValue($key);
    }

    public function getPathUploads()
    {
        $path = $this->getValue(ConfigKeys::SITE_PATH_DATA_UPLOADS);
        if ( !empty($path) && $path[0] != '/') {
            $path = $this->getValue(ConfigKeys::SYSTEM_PATH_ROOT) . DIRECTORY_SEPARATOR . $path;
        }

        return $path;
    }

    protected function validateLayer($layer)
    {
        return in_array($layer, static::$LAYER_ORDER);
    }

    /**
     * @param $layer
     *
     * @return ConfigLayer|null
     */
    protected function getLayer($layer)
    {
        switch ($layer) {
            case static::LAYER_SYSTEM:
                return $this->configLayerSystem;
            case static::LAYER_SITE:
                return $this->configLayerSite;
            case static::LAYER_USER:
                return $this->configLayerUser;
            case static::LAYER_TREE:
                return $this->configLayerTree;
            case static::LAYER_RUNTIME:
                return $this->configLayerRuntime;
            case static::LAYER_THEME:
                return $this->configLayerTheme;
        }

        return null;
    }
}