<?php
/**
 * Created by PhpStorm.
 * User: monzey
 * Date: 14. 12. 14
 * Time: 오후 5:13
 */

namespace ECM\Bundle\HomeBundle\MenusContainer;

use Symfony\Component\DependencyInjection\Container;


class MenusContainer {

    private $doctrine;

    public function __construct(Container $container){
        $this->doctrine = $container->get('doctrine');
    }

    public function getMenus(){
        return $this->doctrine->getRepository('ECMModuleBundle:Menu')->findAll();
    }

    public function getSubMenus($menu){
        return $this->doctrine->getRepository('ECMModuleBundle:Menu')->getSubMenus($menu);
    }

} 