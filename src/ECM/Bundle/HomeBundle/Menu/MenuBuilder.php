<?php
/**
 * Created by PhpStorm.
 * User: monzey
 * Date: 14. 11. 16
 * Time: 오후 2:24
 */

namespace ECM\Bundle\HomeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder extends ContainerAware {

    private $factory;
    private $serviceContainer;

    public function __construct(FactoryInterface $factory, Container $container){
        $this->factory = $factory;
        $this->serviceContainer = $container;
    }

    public function createMainMenu (){
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('', array('route' => 'ecm_home_homepage'))
            ->setAttribute('glyphicon', 'home');

//        $menu->addChild('User')
//            ->setAttribute('dropdown', true);
//
//        $menu['User']->addChild('Profile', array('uri' => '#'))
//            ->setAttribute('divider_append', true);
//        $menu['User']->addChild('Logout', array('uri' => '#'));
//
//        $menu->addChild('Language')
//            ->setAttribute('dropdown', true)
//            ->setAttribute('divider_prepend', true);
//
//        $menu['Language']->addChild('Deutsch', array('uri' => '#'));
//        $menu['Language']->addChild('English', array('uri' => '#'));

        $menu->addChild('Le club')
            ->setAttribute('dropdown', true);
//            ->setAttribute('glyphicon', 'star');

        $menu['Le club']->addChild("Horaires d'ouverture", array('route' => 'ecm_home_horaires'));
        $menu['Le club']->addChild('Tarifs 2014/2015', array('route' => 'ecm_home_tarifs'));
        $menu['Le club']->addChild('Responsables du club', array('route' => 'ecm_home_responsables'))
            ->setAttribute('divider_append', true);
        $menu['Le club']->addChild('Nous contacter', array('route' => 'ecm_home_contact'));

       
        
        $menu->addChild('Equipes jeunes', array('uri' => '#'));
        $menu->addChild('Cours', array('uri' => '#'))
            ->setAttribute('glyphicon', 'book');
        $menu->addChild('Interclub adultes', array('uri' => '#'))
            ->setAttribute('glyphicon', 'tower');
        $menu->addChild('Galerie photo', array('uri' => '#'))
            ->setAttribute('glyphicon', 'camera');

        

        return $menu;
    }
    
     public function createAdminMenu (){
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

         $menu->addChild('Administration', array('route' => 'sonata_admin_dashboard'))
            ->setAttribute('glyphicon', 'lock');
        return $menu;
    }
    
    public function createUserMenu (){
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

         $menu->addChild('Déconnexion', array('route' => 'fos_user_security_logout'))
            ->setAttribute('glyphicon', 'off');
        return $menu;
    }
    
    public function createAnonymousMenu (){
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        
        $menu->addChild('Connexion', array('route' => 'fos_user_security_login'))
            ->setAttribute('glyphicon', 'off');
        $menu->addChild("S'enregistrer", array('route' => 'fos_user_registration_register'))
            ->setAttribute('glyphicon', 'pencil');
        $menu['Connexion']->setAttribute('class', 'navbar-right');
        return $menu;
    }


    public function generateMenu(){

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menus = $this->serviceContainer->get('ecm_home.menus.container')->getMenus();
        foreach ($menus as $menuItem) {
            $slug = $this->serviceContainer->get('slugify')->slugify($menuItem->getTitre());
            $menu->addChild($menuItem->getTitre(), array('route' => 'ecm_articles_show_by_menu', 'routeParameters' => array('titreMenu' => $slug)));
//            $menu->addChild($menuItem->getTitre(), array('uri' => $this->serviceContainer->get('slugify')->slugify($menuItem->getTitre())));
        }

        return $menu;
    }

} 