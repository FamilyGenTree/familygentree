<?php

namespace FamGenTree\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FamGenTreeThemeAdminBundle:Default:index.html.twig', array('name' => 'aad'));
    }
}
