<?php
/**
 * Created by PhpStorm.
 * User: monzey
 * Date: 13/02/15
 * Time: 11:43
 */

namespace ECM\Bundle\ShopBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class ProduitAdmin extends Admin
{

    protected $baseRouteName = 'sonata_produit';
    protected $baseRoutePattern = 'produits';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('description', 'textarea')
            ->add('image', 'sonata_type_model', array('property' => 'nom'))
            ->add('categorie', 'sonata_type_model', array('property' => 'nom'))
            ->add('prix');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('categorie.nom', null, array('label' => 'Categorie'))
            ->add('prix')
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
            ->add('nom')
            ->add('description');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
            ->add('description')
            ->add('prix');
    }


}