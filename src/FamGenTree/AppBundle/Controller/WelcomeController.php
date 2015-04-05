<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.de>.
 * Date: 4/5/15
 * Time: 10:33 AM
 * Copyright (c) WorkingDevelopers.NET
 */

namespace FamGenTree\AppBundle\Controller;

use FamGenTree\AppBundle\Context\Configuration\Domain\ConfigKeys;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{

    public function indexAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render(
            'FamGenTreeThemeMainBundle:Welcome:index.html.twig',
            array(
                'site_name'    => $cfg->getValue(ConfigKeys::SITE_NAME),
                'welcome_text' => $cfg->getValue(ConfigKeys::SITE_WELCOME_TEXT)
            )
        );
    }
}