<?php
/**
 * Created by PhpStorm.
 * User: monzey
 * Date: 14. 11. 16
 * Time: 오후 2:24
 */

namespace ECM\Bundle\HomeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware {

    private $factory;
    private $serviceContainer;

    public function __construct(FactoryInterface $factory, Container $container){
        $this->factory = $factory;
        $this->serviceContainer = $container;
    }

    /*
     * Menu administrateur
     */
    public function createAdminMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

         $menu->addChild('Administration', array('route' => 'sonata_admin_dashboard'))
             ->setAttribute('glyphicon', 'wrench');
        return $menu;
    }

    /*
     * Menu utilisateur (administrateur inclus)
     */
    public function createUserMenu (){
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');


        $menu->addChild('')
            ->setAttribute('glyphicon', 'user')
            ->setAttribute('dropdown', true)
            ->setAttribute('class', 'navbar-right');

        $menu['']->addChild('Proposer article', array('route' => 'article_new'))
            ->setAttribute('glyphicon', 'pencil');
        $menu['']->addChild('Mes articles', array('route' => 'ecm_articles_show_by_util'))
            ->setAttribute('glyphicon', 'book');
        $menu['']->addChild('Modifier mon mot de passe', array('route' => 'fos_user_change_password'))
            ->setAttribute('glyphicon', 'lock');
        $menu['']->addChild('Déconnexion', array('route' => 'fos_user_security_logout'))
            ->setAttribute('glyphicon', 'off');
        
        return $menu;
    }

    /*
     * Menu utilisateur non enregistré
     */
    public function createAnonymousMenu (){
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild("S'enregistrer", array('route' => 'fos_user_registration_register'))
            ->setAttribute('glyphicon', 'pencil');
        $menu->addChild('', array('route' => 'fos_user_security_login'))
            ->setAttribute('glyphicon', 'off');

        return $menu;
    }

    /*
     * Menu général à tous les internautes
     */
    public function generateMenu(){

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menus = $this->serviceContainer->get('ecm_home.menus.container')->getMenus();
        $menu->addChild('', array('route' => 'ecm_home_homepage'))
            ->setAttribute('glyphicon', 'home');
        foreach ($menus as $menuItem) {
            $slug = $this->serviceContainer->get('slugify')->slugify($menuItem->getTitre());
            $menu->addChild($menuItem->getTitre(), array('route' => 'ecm_articles_show_by_menu', 'routeParameters' => array('titreMenu' => $slug)));
            foreach ($menuItem->getEnfants() as $submenuItem) {
                $menu[$menuItem->getTitre()]->setAttribute('dropdown', true);
                $subSlug = $this->serviceContainer->get('slugify')->slugify($submenuItem->getTitre());
                $menu[$menuItem->getTitre()]->addChild($submenuItem->getTitre(), array('route' => 'ecm_articles_show_by_menu', 'routeParameters' => array('titreMenu' => $subSlug)));
            }
        }
        $menu->addChild("Boutique", array('route' => 'categorie'))
            ->setAttribute('glyphicon', 'shopping-cart');

        return $menu;
    }

} 
