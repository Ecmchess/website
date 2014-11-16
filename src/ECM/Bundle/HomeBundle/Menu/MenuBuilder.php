<?php
/**
 * Created by PhpStorm.
 * User: monzey
 * Date: 14. 11. 16
 * Time: 오후 2:24
 */

namespace ECM\Bundle\HomeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder {

    private $factory;

    public function __construct(FactoryInterface $factory){
        $this->factory = $factory;
    }

    public function createMainMenu (){
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('Accueil', array('route' => 'ecm_home_homepage'))
            ->setAttribute('glyphicon', 'home');

        $menu->addChild('User')
            ->setAttribute('dropdown', true);

        $menu['User']->addChild('Profile', array('uri' => '#'))
            ->setAttribute('divider_append', true);
        $menu['User']->addChild('Logout', array('uri' => '#'));

        $menu->addChild('Language')
            ->setAttribute('dropdown', true)
            ->setAttribute('divider_prepend', true);



        $menu['Language']->addChild('Deutsch', array('uri' => '#'));
        $menu['Language']->addChild('English', array('uri' => '#'));

        return $menu;
    }
} 