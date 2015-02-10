<?php

namespace ECM\Bundle\ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('corps', 'ckeditor', array('config_name' => 'config_article_simple'))
            ->add('menu', 'entity', array(
                'class' => 'ECM\Bundle\ModuleBundle\Entity\Menu',
                'property' => 'titre',
                'multiple' => false,
                'required' => true));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(\Symfony\Component\Form\OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ECM\Bundle\ArticleBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ecm_bundle_articlebundle_article';
    }

}
