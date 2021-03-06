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
use Sonata\AdminBundle\Validator\ErrorElement;

/**
 * Description of ArticleAdmin
 *
 * @author hoquyb
 */
class PublicationAdmin extends Admin
{

    protected $baseRouteName = 'sonata_article';
    protected $baseRoutePattern = 'article';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere($query->getRootAlias() . ' NOT INSTANCE OF ECMArticleBundle:Article');
        return $query;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('titre')
            ->add('corps', 'ckeditor')
            ->add('menu', 'sonata_type_model', array('property' => 'titre', 'btn_add' => false));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titre')
            ->add('menu.titre', null, array('label' => 'Menu'))
            // ->add('etat',null,array('label'=>'Etat'))
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


    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('titre')
            ->add('corps');
    }

}
