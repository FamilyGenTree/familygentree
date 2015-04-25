<?php

namespace FamGenTree\AdminBundle\Controller;

use FamGenTree\AppBundle\Context\Configuration\Domain\ConfigKeys;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render(
            'FamGenTreeThemeAdminBundle:Dashboard:index.html.twig',
            array(
                'site_name'    => $cfg->getValue(ConfigKeys::SITE_NAME),
                'welcome_text' => $cfg->getValue(ConfigKeys::SITE_WELCOME_TEXT)
            )
        );
    }
}
