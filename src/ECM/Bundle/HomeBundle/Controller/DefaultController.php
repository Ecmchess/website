<?php

namespace ECM\Bundle\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Template("ECMHomeBundle:Default:index.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        return array();
    }

    /**
     * @Template("ECMHomeBundle:Default:article-vitrine.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function horairesAction() {
//        $article = new Article();
        $em = $this->getDoctrine()->getManager();
        $article = $em->find('ECMArticleBundle:Article', 1);
        return array('article' => $article);
    }

    /**
     * @Template("ECMHomeBundle:Default:article-vitrine.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tarifsAction() {
//        $article = new Article();
        $em = $this->getDoctrine()->getManager();
        $article = $em->find('ECMArticleBundle:Article', 2);
        return array('article' => $article);
    }

    /**
     * @Template("ECMHomeBundle:Default:article-vitrine.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction() {
//        $article = new Article();
        $em = $this->getDoctrine()->getManager();
        $article = $em->find('ECMArticleBundle:Article', 4);
        return array('article' => $article);
    }

    /**
     * @Template("ECMHomeBundle:Default:article-vitrine.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function responsablesAction() {
//        $article = new Article();
        $em = $this->getDoctrine()->getManager();
        $article = $em->find('ECMArticleBundle:Article', 3);
        return array('article' => $article);
    }

    /**
     * @Template("ECMHomeBundle::layout.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showSponsorAction() {
        $em = $this->getDoctrine()->getManager();

        $sponsors = $em->getRepository('ECMModuleBundle:Sponsor')->findAll();

        return array('sponsors' => $sponsors);
    }

}
