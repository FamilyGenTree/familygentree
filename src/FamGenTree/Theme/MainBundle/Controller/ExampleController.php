<?php

namespace FamGenTree\Theme\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExampleController extends Controller
{
    public function indexAction()
    {
        return $this->render('FamGenTreeThemeMainBundle:Example:index.html.twig', array());
    }
}
