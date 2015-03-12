<?php

namespace Skaphandrus\DivingadvisorsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr'=> array('class'=>'form-control', 'placeholder'=>'Name')))
            ->add('email', 'email', array('attr'=> array('class'=>'form-control', 'placeholder'=>'Email')))
            ->add('message', 'textarea', array('attr'=> array('class'=>'form-control', 'placeholder'=>'Message','rows'=>'6')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skaphandrus\DivingadvisorsBundle\Entity\Contact',
            'attr' => array('class' => 'form')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skaphandrus_divingadvisorsbundle_contact';
    }
}
