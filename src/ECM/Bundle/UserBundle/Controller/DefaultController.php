<?php

namespace ECM\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ECM\Bundle\UserBundle\Entity\User;
use ECM\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ECMUserBundle:Default:index.html.twig', array('name' => $name));
    }
    
    /**
     * @Template("ECMUserBundle:Default:login.html.twig")
     * @param Request $request
     * @return type
     */
    public function loginAction (/* Request $request */){
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
//        if('POST' == $request->getMethod()){
//            $form->bind($request);
//            if($form->isValid()){
//            $em = $this->get('doctrine')->getManager();
//            $em->persist($user);
//                $this->redirect($this->generateUrl('ecm_home_homepage'));
//            }
//        }
        return array('loginForm' => $form->createView());
    }
}
