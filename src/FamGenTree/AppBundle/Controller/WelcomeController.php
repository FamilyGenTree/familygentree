<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.de>.
 * Date: 4/5/15
 * Time: 10:33 AM
 * Copyright (c) WorkingDevelopers.NET
 */

namespace FamGenTree\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller {

    public function indexAction() {
        return $this->render(
            'FamGenTreeThemeMainBundle:Welcome:index.html.twig',
            array(
                'welcome_text' => 'bla, böa'
            )
        );

    }
}