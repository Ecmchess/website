<?php
/**
 * Created by PhpStorm.
 * User: monzey
 * Date: 13/02/15
 * Time: 11:49
 */

namespace ECM\Bundle\ShopBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class CategorieAdmin extends Admin
{

    protected $baseRouteName = 'sonata_categorie';
    protected $baseRoutePattern = 'categories';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
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
            ->add('nom');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom');
    }

}