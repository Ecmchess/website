<?php
/**
 * Created by PhpStorm.
 * User: monzey
 * Date: 14. 11. 16
 * Time: 오후 2:24
 */

namespace ECM\Bundle\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder {

    private $factory;

    public function __construct(FactoryInterface $factory){
        $this->factory = $factory;
    }

    public function createMainAdminMenu (){
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

       
        
        $menu->addChild('Administration articles', array('route' => 'ecm_articles_admin'))
            ->setAttribute('glyphicon', 'list-alt');
        $menu->addChild('Administration des sponsors', array('route' => 'admin_sponsor'))
            ->setAttribute('glyphicon', 'flag');

        

        return $menu;
    }

} 