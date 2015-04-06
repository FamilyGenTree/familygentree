<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 WorkingDevelopers.NET
 */

namespace FamGenTree\AppBundle\Context\Configuration\Domain;


class ConfigValue {
    protected $value;
    protected $key;
    protected $layer;
    protected $immutable=false;

    function __construct($value, $immutable, $key, $layer)
    {
        $this->value     = $value;
        $this->immutable = $immutable;
        $this->key       = $key;
        $this->layer     = $layer;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getLayer()
    {
        return $this->layer;
    }

    /**
     * @return boolean
     */
    public function isImmutable()
    {
        return $this->immutable;
    }

    public function asBoolean() {
        return (bool)$this->value;
    }

    public function __toString()
    {
        return $this->value;
    }


}