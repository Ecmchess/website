<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ECM\Bundle\ArticleBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

/**
 * Description of ArticleAdmin
 *
 * @author hoquyb
 */
class ArticleAdmin extends Admin
{

    protected $baseRouteName = 'sonata_publication';
    protected $baseRoutePattern = 'publications';


    public function postUpdate($article)
    {
        if ($article->estRefuse()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('ecmadmin@yopmail.com')
                ->setTo($article->getAuteur()->getEmail())
                ->setBody($this->getConfigurationPool()->getContainer()->get('templating')->renderResponse('ECMArticleBundle:Article:email.txt.twig', array('article' => $article)));
            $this->getConfigurationPool()->getContainer()->get('mailer')->send($message);
        }
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'show', 'edit', 'delete'));
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('titre', 'text')
            ->add('corps', 'ckeditor')
            ->add('menu', 'sonata_type_model', array('property' => 'titre', 'btn_add' => false))
            ->add('etat', 'choice', array('choices' => array('2' => 'Accepter', '3' => 'Refuser'), 'expanded' => true))
            ->add('motif');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titre')
            ->add('menu.titre', null, array('label' => 'Menu'))
            ->add('nomEtat', null, array('label' => 'Etat'))
            ->add('auteur')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )

            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('titre')
            ->add('corps');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('titre')
            ->add('corps', null, array('safe' => true));
    }

}
