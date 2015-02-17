<?php

namespace ECM\Bundle\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ECMShopBundle:Produit')->findAll();

        return $this->render('ECMShopBundle:Shop:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function getProduitsByCategorie($idCategorie)
    {
        $em = $this->getDoctrine()->getManager();


        $entities = $em->getRepository('ECMShopBundle:Default')->findBy(array('categorie_id' => $idCategorie));
        return $this->render('ECMShopBundle:Shop:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ECMShopBundle:Produit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }


        return $this->render('ECMShopBundle:Shop:show.html.twig', array(
            'entity' => $entity,
        ));
    }
}