<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 FamilyGenTree
 */

namespace FamGenTree\AppBundle\Twig;

use FamGenTree\AppBundle\Context\Configuration\Domain\ConfigKeys;
use FamGenTree\AppBundle\Context\Configuration\Domain\FgtConfig;

class AppExtensions extends \Twig_Extension
{
    public function __construct(FgtConfig $config)
    {
        $this->fgtConfig = $config;
    }


    //public function getFilters()
    //{
    //    return array(
    //        new \Twig_SimpleFilter('price', array(
    //            $this,
    //            'priceFilter'
    //        )),
    //    );
    //}

    public function getGlobals()
    {
        return array(
            'site_name' => $this->fgtConfig->get(ConfigKeys::SITE_NAME)
        );
    }


    //public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    //{
    //    $price = number_format($number, $decimals, $decPoint, $thousandsSep);
    //    $price = '$' . $price;
    //
    //    return $price;
    //}

    public function getName()
    {
        return 'fgt_twig_extension';
    }
}
