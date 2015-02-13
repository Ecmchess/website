<?php

namespace ECM\Bundle\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ECMShopBundle:Default:index.html.twig', array('name' => $name));
    }
}
