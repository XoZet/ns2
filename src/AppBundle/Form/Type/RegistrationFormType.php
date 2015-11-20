<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
* 
*/
class RegistrationFormType extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('max_length' => 255, 'label' => 'form.username', 'translation_domain' => 'User'))
            ->add('email', 'email', array('max_length' => 255, 'label' => 'form.email', 'translation_domain' => 'User'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('max_length' => 255, 'translation_domain' => 'User'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'user.password.mismatch',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Security\User'
        ));
    }

    public function getName()
    {
        return 'user_registration';
    }
}