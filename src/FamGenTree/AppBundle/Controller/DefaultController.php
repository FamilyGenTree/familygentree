<?php

namespace FamGenTree\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FamGenTreeThemeMainBundle:Default:index.html.twig', array());
    }
}
