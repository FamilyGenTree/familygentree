<?php

namespace FamGenTree\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthController extends Controller
{
    public function loginAction()
    {
        return $this->render('FamGenTreeThemeAdminFosUserBundle:Security:login.html.twig', array());
    }

    public function logoutAction()
    {
    }
}
