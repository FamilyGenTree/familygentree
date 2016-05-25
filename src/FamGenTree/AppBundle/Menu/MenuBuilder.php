<?php
/**
 * Created by Christoph Graupner <ch.graupner@workingdeveloper.net>.
 *
 * Copyright (c) 2015 WorkingDevelopers.NET
 */

namespace FamGenTree\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class MenuBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem(
            'root',
            [
                'childrenAttributes' => array(
                    'class' => 'nav navbar-nav main-menu'
                )
            ]
        );

        $menu->addChild(
            'Home',
            array_merge(
                [
                    'route' => 'fgt_homepage',
                    'attributes' => [
                        'id' => 'user_edit_profile'
                    ]
                ],
                $options
            )
        );
        $menuDiagrams = $menu->addChild(
            'Diagrams',
            array_merge(
                [
                    'uri' => '#',
                    'attributes' => [
                        'id' => 'user_edit_profile'
                    ],
                    'childrenAttributes' =>
                        array(
                            'role' => 'menu',
                            'class' => 'dropdown-menu'
                        ),
                    'linkAttributes' => [
                        'aria-expanded' => 'false',
                        'role' => 'button',
                        'data-toggle' => 'dropdown',
                        'class' => 'dropdown-toggle'
                    ]

                ],
                $options
            )
        );

        $this->addDiagramMenu($menuDiagrams, $factory, $options);


        $menuLocations = $menu->addChild(
            'Locations',
            array_merge(
                [
                    'route' => 'fgt_homepage',
                    'attributes' => ['id' => 'user_edit_profile']
                ],
                $options
            )
        );

        // ... add more children

        return $menu;
    }

    protected function addDiagramMenu(ItemInterface $menu, FactoryInterface $factory, $options)
    {
        $menu->addChild(
            'Pedigree',
            array_merge(
                [
                    'route' => 'fgt_homepage',
                    //'routeParameters' => array('id' => $blog->getId()),
                    'attributes' => [
                        'id' => 'menu_user_admin_home'
                    ]
                ],
                $options
            )
        );
        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem(
            'root',
            array(
                'childrenAttributes' => array(
                    'class' => 'nav navbar-nav navbar-right'
                )
            )
        );
        $menuUser = $menu->addChild(
            'User',
            [
                'uri' => '#',
                //                'route' => 'fos_user_profile_edit',
                //'currentAsLink' => true
                //'class' => 'dropdown',
                //'branch_class' => 'dropdown',
                //                'attributes' =>
                'childrenAttributes' => array(
                    'role' => 'menu',
                    'class' => 'dropdown-menu'
                ),
                'linkAttributes' => [
                    'aria-expanded' => 'false',
                    'role' => 'button',
                    'data-toggle' => 'dropdown',
                    'class' => 'dropdown-toggle'
                ]
            ]
        );

        if ($this->getAuth()->isLoggedIn()) {
            $this->addLoginMenu($menuUser, $factory, $options);
        } else {
            $this->addLoggedOutMenu($menuUser, $factory, $options);
        }

        return $menu;
    }

    /**
     * @return \FamGenTree\AppBundle\Service\Auth
     */
    protected function getAuth()
    {
        return $this->container->get('fgt.auth');
    }

    protected function addLoginMenu(ItemInterface $menu, FactoryInterface $factory, $options)
    {
        $menu->addChild(
            'Edit profile',
            array_merge(
                [
                    'route' => 'fos_user_profile_edit',
                    //'routeParameters' => array('id' => $blog->getId()),
                    'attributes' => [
                        'id' => 'user_edit_profile'
                    ]
                ],
                $options
            )
        );
        if ($this->getAuth()->isAdmin()) {
            $menu->addChild(
                '',
                [
                    'attributes' => [
                        'class' => 'divider'
                    ],

                ]
            );
            $menu->addChild(
                'Administration',
                array_merge(
                    [
                        'route' => 'fgt_admin_homepage',
                        //'routeParameters' => array('id' => $blog->getId()),
                        ['attributes' => ['id' => 'menu_user_admin_home']]
                    ],
                    $options
                )
            );
        }
        $menu->addChild(
            '',
            [
                'attributes' => [
                    'class' => 'divider'
                ],
            ]
        );
        $menu->addChild(
            'Logout',
            array_merge(
                [
                    'route' => '_fgt_logout',
                    //'routeParameters' => array('id' => $blog->getId()),
                    ['attributes' => ['id' => 'user_edit_profile']]
                ],
                $options
            )
        );

        return $menu;
    }

    protected function addLoggedOutMenu(ItemInterface $menu, FactoryInterface $factory, $options)
    {
        $menu->addChild(
            '',
            [
                'attributes' => [
                    'class' => 'divider'
                ]
            ]
        );
        $menu->addChild(
            'Register',
            array_merge(
                [
                    'route' => '_fgt_login',
                    //'routeParameters' => array('id' => $blog->getId()),
                    ['attributes' => ['id' => 'menu_user_admin_home']]
                ],
                $options
            )
        );
        return $menu;
    }

    protected function addCssClass(ItemInterface $menu, $class)
    {
        $classes = preg_split('/\s+/', $menu->getAttribute('class'));
        $classes[] = $class;
        $menu->setAttribute('class', implode(' ', $classes));
    }
}
