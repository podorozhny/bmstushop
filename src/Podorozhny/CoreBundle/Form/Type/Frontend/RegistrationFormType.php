<?php

namespace Podorozhny\CoreBundle\Form\Type\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType {
    private $class;

    public function __construct($class) {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('email', 'email', [
                'label' => 'form.email',
                'attr'  => ['placeholder' => 'E-mail'],
            ])
            ->add('plainPassword', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'validation.password.mismatch',
                'options'         => array('translation_domain' => 'FOSUserBundle'),
                'first_options'   => array(
                    'label' => 'form.password',
                    'attr'  => ['placeholder' => 'Password']
                ),
                'second_options'  => array(
                    'label' => 'form.password_confirmation',
                    'attr'  => ['placeholder' => 'Password confirmation']
                ),
            ))
            ->add('firstname', 'text', [
                'label' => 'form.firstname',
                'attr'  => ['placeholder' => 'Firstname'],
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
                                   'data_class' => $this->class,
                                   'intention'  => 'registration',
                               ));
    }

    public function getName() {
        return 'frontend_registration_form_type';
    }
}