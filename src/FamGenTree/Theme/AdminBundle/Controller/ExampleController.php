<?php

namespace FamGenTree\Theme\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExampleController extends Controller
{
    public function indexAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:index.html.twig', array('name' => 'bla'));
    }

    public function basicTableAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:basic_table.html.twig', array('name' => 'bla'));
    }

    public function blankAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:blank.html.twig', array('name' => 'bla'));
    }

    public function buttonsAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:buttons.html.twig', array('name' => 'bla'));
    }

    public function calendarAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:calendar.html.twig', array('name' => 'bla'));
    }

    public function chartJsAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:chartjs.html.twig', array('name' => 'bla'));
    }

    public function formComponentAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:form_component.html.twig', array('name' => 'bla'));
    }

    public function galleryAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:gallery.html.twig', array('name' => 'bla'));
    }

    public function generalAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:general.html.twig', array('name' => 'bla'));
    }

    public function lockScreenAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:lock_screen.html.twig', array('name' => 'bla'));
    }

    public function loginAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:login.html.twig', array('name' => 'bla'));
    }

    public function morrisAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:morris.html.twig', array('name' => 'bla'));
    }

    public function panelsAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:panels.html.twig', array('name' => 'bla'));
    }

    public function responsiveTableAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:responsive_table.html.twig', array('name' => 'bla'));
    }

    public function todoListAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Example:todo_list.html.twig', array('name' => 'bla'));
    }
}
