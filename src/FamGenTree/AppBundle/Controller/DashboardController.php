<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.de>.
 * Date: 4/5/15
 * Time: 10:35 AM
 * Copyright (c) WorkingDevelopers.NET
 */

namespace FamGenTree\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller {

    public function indexAction() {
        return $this->render('FamGenTreeThemeMainBundle:Dashboard:index.html.twig', array());

    }

}