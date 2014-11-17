<?php

// src/ECM/Bundle/HomeBundle/Form/Type/UserType.php

namespace ECM\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('login');
        $builder->add('pass');
        
    }
    
    
    
    public function getName(){
        return 'connexion';
    }
    
}