<?php

namespace ECM\Bundle\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ECM\Bundle\ArticleBundle\Form\Type\ArticleType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('ECMArticleBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * @Template("ECMArticleBundle:Default:show.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArticlesByMenuAction($titreMenu){
        $aR = $this->getDoctrine()->getRepository('ECMArticleBundle:Article');
        $mR = $this->getDoctrine()->getRepository('ECMModuleBundle:Menu');
        $titreMenu = ucfirst(preg_replace('#-#', ' ', $titreMenu));
        $menu = $mR->findOneBy(array('titre' => $titreMenu));
        $articles = $aR->findBy(array('menu' => $menu));
        return array('articles' => $articles, 'menu' => $titreMenu);
    }

    /**
     * @Template("ECMArticleBundle:Default:administration-articles.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function administrationArticlesAction() {
        $em = $this->getDoctrine()->getRepository('ECMArticleBundle:Article');
        $articles = $em->findAll();
        return array('articles' => $articles);
    }

    /**
     * @Template("ECMArticleBundle:Default:modifier-article.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function modifierAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->find('ECMArticleBundle:Article', $id);
        $form = $this->createForm(new ArticleType(), $article);
        if (!$article) {
            throw $this->createNotFoundException('L\'Article n\'existe pas');
        }
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($article);
                $em->flush();
                $request->getSession()->getFlashBag()->add('ECMArticleBundle:Article', 'Article bien modifiée.');
                return $this->redirect($this->generateUrl('ecm_articles_admin', array('id' => $article->getId())));
                //return $this->generateUrl('ecm_articles_admin');
            }
        }
        return array('form' => $form->createView());
    }

}
