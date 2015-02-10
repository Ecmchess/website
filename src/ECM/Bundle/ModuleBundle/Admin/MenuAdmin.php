<?php

namespace ECM\Bundle\ModuleBundle\Admin;

use ECM\Bundle\ModuleBundle\Entity\SubMenu;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MenuAdmin extends Admin
{

    protected $baseRouteName = 'sonata_menu';
    protected $baseRoutePattern = 'menu';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('titre')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titre')
            ->add('parent')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();
        $formMapper
            ->add('titre')
            ->add('glyphicon');
        $query = $this->modelManager->getEntityManager('ECM\Bundle\ModuleBundle\Entity\Menu')->createQuery('SELECT m FROM ECM\Bundle\ModuleBundle\Entity\Menu m WHERE m NOT INSTANCE OF ECM\Bundle\ModuleBundle\Entity\SubMenu');
        if ($subject instanceof SubMenu) {
            $formMapper
                ->add('parent', 'sonata_type_model', array(
                    'property' => 'titre',
                    'multiple' => false,
                    'class' => 'ECM\Bundle\ModuleBundle\Entity\Menu',
                    'query' => $query
                ));
        }
//        if($subject instanceof Menu){
//            $formMapper->add('', 'sonata_type_collection', array(), array(
//                'edit' => 'inline',
//                'inline' => 'table',
//                'sortable'  => 'position'
//            ));
//        }

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('titre')
        ;
    }


}
