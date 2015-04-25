<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 FamilyGenTree
 */

namespace FamGenTree\AdminBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddUser extends AbstractType
{
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'fgt_admin_add_user';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('realName', 'text',
                  array(
                      'required' => true,
                      'trim'     => true
                  )
            )->add('userName', 'text',
                   array(
                       'required' => true,
                       'trim'     => true
                   )
            )->add('email', 'email',
                   array(
                       'required' => true,
                       'trim'     => true
                   )
            )->add('password', 'password',
                   array(
                       'required' => true
                   )
            )->add('passwordRepeat', 'password',
                   array(
                       'mapped'   => false,
                       'required' => true
                   )
            )->add('submit', 'submit',
                   array(
                   )
            );
    }
}
