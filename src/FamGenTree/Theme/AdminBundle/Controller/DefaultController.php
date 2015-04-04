<?php

namespace FamGenTree\Theme\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FamGenTreeThemeAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
