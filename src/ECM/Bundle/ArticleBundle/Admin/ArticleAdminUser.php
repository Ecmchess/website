<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ECM\Bundle\ArticleBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use ECM\Bundle\ArticleBundle\Entity\Article;

/**
 * Description of ArticleAdminUser
 *
 * @author hoquyb
 */
class ArticleAdminUser extends Admin{
    
    protected $baseRouteName = 'sonata_article_user';
    protected $baseRoutePattern = 'article_user';
    
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('accepte','choice', array('choices'=>array('2' => 'accepter','3' => 'refuser')))
            ->add('titre')
            ->add('corps', 'ckeditor')
            ->add('menu', 'sonata_type_model', array('property' => 'titre', 'btn_add' => false))
            ;
    }
    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titre')
            ->add('menu.titre', null, array('label'=>'Menu'))
            ->add('accepte',null,array('label'=>'Etat'))
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
            ->add('corps')
        ;
    }

 
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('titre')
            ->add('corps')
        ;
    }
    
}
