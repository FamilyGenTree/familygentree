<?php

namespace FamGenTree\Theme\AdminBundle\Controller;

use FamGenTree\AppBundle\Context\Configuration\Domain\ConfigKeys;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExampleController extends Controller
{
    public function indexAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render(
            'FamGenTreeThemeAdminBundle:Example:index.html.twig',
            array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),)
        );
    }

    public function basicTableAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:basic_table.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function blankAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:blank.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function buttonsAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:buttons.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function calendarAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:calendar.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function chartJsAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:chartjs.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function formComponentAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:form_component.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function galleryAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:gallery.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function generalAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:general.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function lockScreenAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:lock_screen.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function loginAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:login.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function morrisAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:morris.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function panelsAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:panels.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function responsiveTableAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:responsive_table.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function todoListAction()
    {
        $cfg = $this->get('fgt.configuration');

        return $this->render('FamGenTreeThemeAdminBundle:Example:todo_list.html.twig', array('site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),));
    }

    public function iconOverviewAction()
    {
        $cfg       = $this->get('fgt.configuration');
        $kernel    = $this->get('kernel');
        $path      = $kernel->locateResource('@FamGenTreeThemeAdminBundle/Resources/public/font-awesome/css/font-awesome.css');
        $iconStyle = [];
        $contents  = file($path);
        foreach ($contents as $line) {
            $matches = [];

            if (preg_match('/.fa-([^:]+):before/', $line, $matches)) {
                $iconStyle[] = $matches[1];
            }
        }
        sort($iconStyle);

        return $this->render(
            'FamGenTreeThemeAdminBundle:Example:icons-overview.html.twig',
            array(
                'site_name' => $cfg->getValue(ConfigKeys::SITE_NAME),
                'awesome_font_icons' => $iconStyle
            )

        );
    }
}
