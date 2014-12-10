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
 * Description of ArticleAdmin
 *
 * @author hoquyb
 */
class ArticleAdmin extends Admin{
    protected $baseRouteName = 'sonata_article';
    protected $baseRoutePattern = 'article';
    
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('titre')
            ->add('corps');
    }
    
}
