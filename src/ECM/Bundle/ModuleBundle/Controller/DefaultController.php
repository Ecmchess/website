<?php

namespace ECM\Bundle\ModuleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ECMModuleBundle:Default:index.html.twig', array('name' => $name));
    }
}
