<?php

namespace Esprit\RealEstateAgencyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MailType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('to', 'email')
                
                ->add('sujet', 'text')
               
                ->add('text', 'textarea')
        ;
    }

    public function getName() {
        return 'Mail';
    }

}
