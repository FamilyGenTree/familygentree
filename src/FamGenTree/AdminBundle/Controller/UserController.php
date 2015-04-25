<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 FamilyGenTree
 */

namespace FamGenTree\AdminBundle\Controller;

use FamGenTree\AdminBundle\Form\User\AddUser;
use FamGenTree\AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function indexAction()
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $repo  = $em->getRepository(User::CLASSNAME);
        $users = $repo->findAll();

        return $this->render(
            'FamGenTreeThemeAdminBundle:User:index.html.twig',
            array(
                'users' => $users
            )
        );
    }

    public function addUserAction()
    {
        $user = new User();
        $form = $this->createForm(new AddUser(), $user);

        return $this->render(
            'FamGenTreeThemeAdminBundle:User:add-user.html.twig',
            array(
                'form' => $form->createView()
            )

        );
    }
}
